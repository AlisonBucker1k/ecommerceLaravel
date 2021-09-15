<?php

namespace Payments\PagarMe;

use Payments\AbstractIntegration;

class Order extends AbstractIntegration
{
    protected $items;
    protected $customer;
    protected $billingAddress;
    protected $shipping;
    protected $payments;
    protected $code;
    protected $sessionId;
    protected $iP;
    protected $location;
    protected $device;
    protected $params;

    public function create($params)
    {
        $this->validate();
    }

    private function validate()
    {
        // validate $this->params;
    }
}
