<?php

namespace Payments\PagarMe\Order;

use App\Customer;
use PagarMe\PagarMe;

/**
 * TODO remover
 * ->preciso dessa classe?<-
 * Através de um pedido é possível gerar pagamentos de maneira muito mais completa.
 * Desta forma, você consegue explorar diversos recursos exclusivos da nossa API.
 */
class Order extends PagarMe
{
    public function __construct(Customer $customer)
    {
        dd('order');
        $this->customer = $customer;
    }
    
    protected $id;
    protected $currency;
    protected $status;
    protected $code;
    protected $customer;
    protected $shipping;
    protected $antifraud;
    protected $charges;
    protected $items;
    protected $closed; // Default: true
    protected $createdAt; // Default: true
    protected $metadata; // Default: true

    protected $billingAddress;
    protected $payments;
    
    protected $sessionId;
    protected $ip;
    protected $location;
    protected $device;    
}

