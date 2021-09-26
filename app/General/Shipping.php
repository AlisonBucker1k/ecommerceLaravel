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

    /**
     * @param Cart $cart
     * @param $cep
     * @param null $shippingId
     * @return mixed
     * @throws Exception
     */
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

    /**
     * @param int $shippingId
     * @return array
     * @throws Exception
     */
    private function handleShipping(int $shippingId)
    {
        $result = [];
        $defaultResult = [
            'id' => $shippingId,
            'description' => Enums\Shipping::getDescription($shippingId),
            'warning' => null,
            'value' => null,
            'deadline' => null
        ];

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
            return $result;
        }

        return array_merge($defaultResult, $result);
    }

    private function calculateLocalShipping() {
        $result = [];
        $findCep = zipcode($this->cep);
        if (empty($findCep)) {
            return $result;
        }

        $address = $findCep->getObject();

        switch ($address->ibge) {
            case 3205309: // Vitória
            case 3205200: // Vila Velha
                $result['value'] = 0;
                $result['deadline'] = 3 + config('app.shipping.additional_shipping_days');
                break;
        }

        return $result;
    }

    /**
     * @return array
     */
    private function calculateRedeemInStore() {
        $result['value'] = 0;
        $result['deadline'] = config('app.shipping.additional_shipping_days');

        return $result;
    }

    /**
     * @param $shippingType
     * @return mixed
     * @throws Exception
     */
    private function calculateCorreios($shippingType)
    {
        $cep = $this->cep;
        $postalCode = getOnlyNumber(config('app.shipping.postal_code'));

        $correios = new Client();
        $calculate = $correios
            ->freight()
            ->origin($postalCode)
            ->destination($cep)
            ->services($shippingType);

        $cart = $this->cart;
        $cartProducts = $cart->cartProducts()->get();
        $totalValue = 0;
        foreach ($cartProducts as $cartProduct) {
            $variation = $cartProduct->variation;
            if (ProductVariation::checkAvailable($variation)) {
                $calculate->item($variation->width, $variation->height, $variation->length, ($variation->weight / 1000), $cartProduct->quantity);
                $totalProductValue = $cart->value * $cart->quantity;
                $totalValue += $totalProductValue;
            }
        }

        $results = $calculate->calculate();
        $result = array_shift($results);
        if (isset($result['error']) && !empty($result['error']) && (!isset($result['error']['code']) || isset($result['error']['code']) && $result['error']['code'] != '011')) {
            throw new Exception($result['error']['message']);
        }

        $warning = null;
        if (isset($result['error']['code']) && $result['error']['code'] == '011') {
            $warning = $result['error']['message'];
        }

        $formatResult['warning'] = $warning;
        $formatResult['value'] = $result['price'];
        $formatResult['deadline'] = $result['deadline'] + config('app.shipping.additional_shipping_days');

        return $formatResult;
    }
}
