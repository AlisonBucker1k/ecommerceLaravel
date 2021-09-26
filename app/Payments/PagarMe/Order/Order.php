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

/*
 {
  "items": [
    {
      "amount": 2990,
      "description": "Chaveiro do Tesseract",
      "quantity": 1
    }
  ],
  "customer": {
    "name": "Tony Stark",
    "email": "avengerstark@ligadajustica.com.br"
  },
  "payments": [{
    "payment_method": "credit_card",
    "credit_card": {
      "installments": 1,
      "statement_descriptor": "AVENGERS",
      "card_id": "card_oqyg5aZuP2zK1dja",
      "card": {
        "cvv": "123"
      }
    }
  }]
} 
 
 */
