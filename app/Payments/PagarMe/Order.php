<?php

namespace Payments\PagarMe;

use PagarMe\PagarMeIntegration;

class Order extends PagarMeIntegration
{
    private $items;
    private $customer;
    private $billingAddress;
    private $shipping;
    private $payments;
    private $code;
    private $sessionId;
    private $iP;
    private $location;
    private $device;
    private $params; // TODO private or protected?

    public function createOrder($params)
    {
        $this->validate();
    }

    private function validate()
    {
        // validate $this->params;
    }
}
