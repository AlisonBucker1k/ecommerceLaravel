<?php

namespace Payments\PagarMe\Order;

use App\Customer;
use PagarMe\PagarMe;

/**
 * TODO remover
 * Através de um pedido é possível gerar pagamentos de maneira muito mais completa.
 * Desta forma, você consegue explorar diversos recursos exclusivos da nossa API.
 */
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
