<?php

namespace App\General;

use App\ProductVariation;
use Exception;
use FlyingLuscas\Correios\Client;

class RedeemInStore implements ShippingInterface
{
    private $cep;
    private $cart;

    public function calculate(Cart $cart, $cep, $shippingId = null)
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
