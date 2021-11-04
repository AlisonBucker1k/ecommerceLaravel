<?php

namespace App\General;

use App\Cart;

interface ShippingInterface
{
    public function calculate(Cart $cart, $cep, $shippingId = null);
}
