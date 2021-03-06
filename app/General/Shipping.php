<?php

namespace App\General;

use App\Cart;
use App\Enums;
use App\ProductVariation;
use Exception;
use FlyingLuscas\Correios\Client;
use FlyingLuscas\Correios\Service;

class Shipping
{
    private $cep;
    private $cart;
    private const CARIACICA_IBGE_CODE = 3201308;

    public function calculate(Cart $cart, $cep, $shippingId = null)
    {
        $result = [];
        $this->cep = $cep;
        $this->cart = $cart;

        if (!empty($shippingId)) {
            $result = $this->handleShipping($shippingId);
        }

        $shippings = \App\Shipping::getAllActiveShippings();
        foreach ($shippings as $shipping) {
            $shippingId = $shipping->id;
            $calculateResult = $this->handleShipping($shippingId);
            if (!empty($calculateResult)) {
                $result[$shippingId] = $calculateResult;
            }
        }

        return $result;
    }

    private function handleShipping(int $shippingId)
    {
        $defaultResult = [
            'id' => $shippingId,
            'description' => Enums\Shipping::getDescription($shippingId),
            'warning' => '',
            'value' => 0.0,
            'deadline' => 3,
        ];

       $result = [];
       switch ($shippingId) {
           case Enums\Shipping::SEDEX:
               $result = $this->calculateCorreios(Service::SEDEX);
               break;
           case Enums\Shipping::PAC:
               $result = $this->calculateCorreios(Service::PAC);
               break;
           case Enums\Shipping::REDEEM_IN_STORE:
               $result = $this->calculateRedeemInStore();
               break;
           case Enums\Shipping::LOCAL_SHIPPING:
               $result = $this->calculateLocalShipping();
               break;
       }

       if (empty($result)) {
           return $defaultResult;
       }

       return array_merge($defaultResult, $result);
    }

    private function calculateLocalShipping()
    {
        $result = [
            'value' => 0,
            'deadline' => 3 + config('app.shipping.additional_shipping_days'),
            'warning' => '',
        ];

        try {
            $findCep = zipcode(getOnlyNumber($this->cep));
            if (empty($findCep)) {
                throw new Exception();
            }

            $address = $findCep->getObject();
            if (empty($address)) {
                throw new Exception();
            }
        } catch (Exception $e) {
            return $result;
        }

        if ($address->ibge == self::CARIACICA_IBGE_CODE) {
            $result['value'] = 0;
            $result['deadline'] = 1 + config('app.shipping.additional_shipping_days');
            $result['warning'] = '';

        }

        return $result;
    }

    private function calculateRedeemInStore(): array
    {
        return [
            'value' => 0.0,
            'deadline' => 0,
            'warning' => '',
        ];
    }

    private function calculateCorreios($shippingType)
    {
        $calculate = (new Client())
            ->freight()
            ->origin(maskCep(config('app.shipping.postal_code')))
            ->destination(maskCep($this->cep))
            ->services($shippingType);

        $totalValue = 0;

        $cart = $this->cart;
        $cartProducts = $cart->cartProducts()->get();

        foreach ($cartProducts as $cartProduct) {
            $variation = $cartProduct->variation;
            if (!ProductVariation::checkAvailable($variation)) {
                continue;
            }

            $sum = $variation->width + $variation->height + $variation->length;
            if ($sum > 200) {
                $variation->width = 66;
                $variation->height = 66;
                $variation->length = 66;
            }
        }

        foreach ($cartProducts as $cartProduct) {
            $variation = $cartProduct->variation;
            if (!ProductVariation::checkAvailable($variation)) {
                continue;
            }

            $calculate->item(
                $variation->width,
                $variation->height,
                $variation->length,
                ($variation->weight / 1000),
                $cartProduct->quantity
            );

            $totalProductValue = $cart->value * $cart->quantity;
            $totalValue += $totalProductValue;
        }

        $results = $calculate->calculate();
        $result = array_shift($results);
        if (isset($result['error']) && !empty($result['error']) && (!isset($result['error']['code']) || isset($result['error']['code'])) && $result['error']['code'] != '011' && $result['error']['code'] != '010') {
            throw new Exception($result['error']['message']);
        }

        $warning = '';
        if (isset($result['error']['code']) && in_array($result['error']['code'], ['010', '011'])) {
            $warning = $result['error']['message'];
        }

        $formatResult['warning'] = $warning;
        $formatResult['value'] = $result['price'];
        $formatResult['deadline'] = $result['deadline'] + config('app.shipping.additional_shipping_days');

        return $formatResult;
    }
}
