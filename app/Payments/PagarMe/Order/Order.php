<?php

namespace Payments\PagarMe\Order;

use PagarMe\PagarMe;

class Order extends PagarMe
{
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
