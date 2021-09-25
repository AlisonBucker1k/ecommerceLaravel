<?php

namespace Payments\PagarMe\Order;

use App\Customer;
use PagarMe\PagarMe;

class Order extends PagarMe
{
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    
    protected $items;
    protected $customer;
    protected $billingAddress;
    protected $shipping;
    protected $payments;
    protected $code;
    protected $sessionId;
    protected $ip;
    protected $location;
    protected $device;    
}
