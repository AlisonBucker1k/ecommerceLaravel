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

    public function create($params)
    {
        dd('asd');
        $items = [
            [
                'amount' => 1.58,
                'description' => 1.58,
                'quantity' => 1,
            ],
        ];

        // $customer = new stdClass();
        // $customer->name = 'teste teste';
        // $customer->name = 'teste@teste.com';

        $payments = [
            [
                'payment_method' => 'credit_card',
                'credit_card' => [
                    'installments' => 1,
                    'statement_descriptor' => 'teste',
                    'card_id' => 'card_oqyg5aZuP2zK1dja',
                    'card' => [
                        'cvv' => '123',
                    ],
                ],
            ],
        ];
        
        // $this->validate();

        $cart = Cart::getCart($this->customer->id);
        if ($cart->totalProducts() <= 0) {
            throw new Exception('Adicione um produto no carrinho efetuar a compra');
        }

        $address = Address::query()->where(['customer_id' => $this->customer->id, 'id' => $addressId])->first();

        $shipping = new Shipping();
        $result = $shipping->calculate($cart, $address->postal_code, $params->shipping_id);
        if (empty($result)) {
            throw new Exception('Não foi possível calcular o frete, tente novamente mais tarde.');
        }

        $totalValue = $result['value'] + $cart->totalValue();
        
        // TODO corrigir atribuição de valores dos parâmetros

        $client = new Client(config('PAGAR_ME_API_TOKEN'));
        $transaction = $client->transactions()->create([
            'amount' => $totalValue,
            'payment_method' => $this->params->payment_method,
            'card_holder_name' => $this->params->amount,
            'card_cvv' => $this->params->amount,
            'card_number' => $this->params->amount,
            'card_expiration_date' => $this->params->amount,
            'customer' => [
                'external_id' => $this->customer->id,
                'name' => $this->customer->name,
                'type' => 'individual', // TODO corrigir
                'country' => $this->customer->country,
                'documents' => [
                  [
                    'type' => $this->customer->amount,
                    'number' => $this->customer->amount,
                  ]
                ],
                'phone_numbers' => [ $this->customer->phone ],
                'email' => $this->customer->email,
            ],
            'billing' => [
                'name' => $this->billingAddress->name,
                'address' => [
                  'country' => $this->billingAddress->country,
                  'street' => $this->billingAddress->street,
                  'street_number' => $this->billingAddress->street_number,
                  'state' => $this->billingAddress->state,
                  'city' => $this->billingAddress->city,
                  'neighborhood' => $this->billingAddress->neighborhood,
                  'zipcode' => $this->billingAddress->zipcode,
                ]
            ],
            'shipping' => [
                'name' => $this->shipping->name,
                'fee'=> $this->shipping->fee,
                'delivery_date' => $this->shipping->delivery_date,
                'expedited' => $this->shipping->expedited,
                'address' => [
                  'country' => $this->shipping->address->country,
                  'street' => $this->shipping->address->street,
                  'street_number' => $this->shipping->address->street_number,
                  'state' => $this->shipping->address->state,
                  'city' => $this->shipping->address->city,
                  'neighborhood' => $this->shipping->address->neighborhood,
                  'zipcode' => $this->shipping->address->zipcode,
                ]
            ],
            /*
                TODO verificar se está vindo corretamente
                $items should be:
                $items = [
                    [
                    'id' => $this->params->amount,
                    'title' => $this->params->amount,
                    'unit_price' => $this->params->amount,
                    'quantity' => $this->params->amount,
                    'tangible' => $this->params->amount,
                    ],
                ];
            */
            // 'items' => $this->items,
            'items' => $items,
        ]);

        return $transaction;
    }
}

