<?php

namespace Payments\PagarMe\Order;

use App\Address;
use App\Cart;
use App\General\Shipping;
use Exception;
use PagarMe\Client;

class CreateOrder extends Order
{
    public function create($params)
    {
        $this->validate();

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
            'items' => $this->items,
        ]);

        return $transaction;
    }

    // TODO testar validação
    private function validate(): void
    {
        $this->items = $this->params->items;
        if (empty($this->items)) {
            throw new Exception('Informe os itens do pedido.');
        }

        $this->customer = $this->params->customer;
        if (empty($this->customer)) {
            throw new Exception('Informe os dados do cliente.');
        }

        $this->billingAddress = $this->params->billingAddress;
        if (empty($this->billingAddress)) {
            throw new Exception('Informe os dados do endereço de cobrança.');
        }

        $this->shipping = $this->params->shipping;
        if (empty($this->shipping)) {
            throw new Exception('Informe os dados do frete.');
        }

        $this->payments = $this->params->payments;
        if (empty($this->payments)) {
            throw new Exception('Informe os dados do pagamento.');
        }

        $this->code = $this->params->code;
        if (empty($this->code)) {
            throw new Exception('Informe o código');
        }

        $this->ip = $this->params->ip;
        if (empty($this->ip)) {
            throw new Exception('Informe o IP.');
        }

        $this->location = $this->params->location;
        if (empty($this->location)) {
            throw new Exception('Informe o location'); // TODO corrigir descrição
        }

        $this->device = $this->params->device;
        if (empty($this->device)) {
            throw new Exception('Informe o dispositivo.'); // TODO qual dispositivo? -> talvez seja o sistema AntiFraude
        }
    }
}
