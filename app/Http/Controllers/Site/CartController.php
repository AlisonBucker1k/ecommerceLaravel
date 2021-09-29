<?php

namespace App\Http\Controllers\Site;

use App\Address;
use App\Cart;
use App\CartProduct;
use App\General\Shipping;
use App\Http\Controllers\Controller;
use App\Order;
use Exception;
use Illuminate\Http\Request;
use App\Product;
use App\ProductVariation;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use PagarMe\Client;
use Payments\PagarMe\Order\CreateOrder;
use Payments\PagarMe\Order\Order as OrderOrder;

class CartController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function index(Request $request)
    {
        $customerId = null;
        if (auth()->check()) {
            $customer = auth()->user();
            $customerId = auth()->id();
            $addresses = $customer->activeAddresses;
            $data['addresses'] = $addresses;
        }

        $cart = Cart::getCart($customerId, Cookie::get('cart_token'));
        $this->removeUnavailableProducts($cart, $request);
        $data['cart'] = $cart;
        // dd($cart->cartProducts);

        return view('site.cart', $data);
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return mixed
     */
    public function addProduct(Product $product, Request $request)
    {
        $variationId = $request->post('variation_id');
        $variation = ProductVariation::query()->find($variationId);

        $customerId = auth()->id();
        $cart = Cart::getCart($customerId, Cookie::get('cart_token'));
        $cart->addProduct($product, $variation);

        return redirect()->route('cart')->withSuccess('Produto adicionado com sucesso!');
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function editCartProduct(Request $request)
    {
        $cartProduct = CartProduct::query()->find($request->post('cart_product_id'));
        $cartProduct->quantity = $request->post('quantity');
        $cartProduct->update();

        return [];
    }

    /**
     * @param CartProduct $cartProduct
     * @return mixed
     * @throws Exception
     */
    public function removeProduct(CartProduct $cartProduct)
    {
        $cartProduct->delete();

        return redirect()->route('cart')->withSuccess('Produto removido com sucesso!');
    }

    /**
     * Calculate the order freight.
     *
     * @param Request $request
     * @return false|string
     */
    public function calculateFreight(Request $request)
    {
        try {
            $customerId = null;
            $cep = getOnlyNumber($request->get('cep'));
            if (auth()->check()) {
                $customerId = auth()->user()->id;
            }

            $cart = Cart::getCart($customerId, Cookie::get('cart_token'));

            $shipping = new Shipping();
            $result = $shipping->calculate($cart, $cep);
        } catch (Exception $e) {
            $result['error'] = true;
            $result['message'] = $e->getMessage();
        }

        return json_encode($result);
    }

    public function confirmOrder(Request $request)
    {
        $customer = auth()->user();
        $cart = Cart::getCart($customer->id, Cookie::get('cart_token'));
        $this->removeUnavailableProducts($cart, $request);

        $cartProducts = $cart->cartProducts()->count();
        if ($cartProducts === 0) {
            return redirect()->route('cart')->withErrors('Adicione um produto no carrinho');
        }

        $data['addresses'] = $customer->activeAddresses;
        $data['cart'] = $cart;

        return view('site.cart_confirm', $data);
    }

    private function removeUnavailableProducts(Cart $cart, Request $request)
    {
        $cartProducts = $cart->cartProducts()->get();
        foreach ($cartProducts as $cartProduct) {
            $variation = $cartProduct->variation;
            $product = $cartProduct->product;

            if (!ProductVariation::checkAvailable($variation)) {
                $request->session()->flash('warning', 'O produto ' . $product->name . ' não está mais disponível');

                $cartProduct->delete();
            }

            if ($variation->stock_quantity < $cartProduct->quantity) {
                $request->session()->flash('warning', 'O produto ' . $product->name . ' não possui o estoque disponível para essa quantidade');

                $cartProduct->delete();
            }
        }
    }

    public function createOrder(Request $request)
    {
        DB::beginTransaction();

        try {
            $params = $request->post();
            $params['address_id'] = 1;
            $params['shipping_id'] = 1; // sedex
            $customer = auth()->user();

            $cart = Cart::getCart($customer->id);
            if ($cart->totalProducts() <= 0) {
                throw new Exception('Adicione um produto no carrinho efetuar a compra');
            }
    
            $address = Address::query()->where(['customer_id' => $customer->id, 'id' => $params['address_id']])->first();
    
            $shipping = new Shipping();
            $shippingDetails = $shipping->calculate($cart, $address->postal_code, $params['shipping_id']);
            if (empty($shippingDetails)) {
                throw new Exception('Não foi possível calcular o frete, tente novamente mais tarde.');
            }
    
            $totalValue = $shippingDetails['value'] + $cart->totalValue();
            $totalValue = 1.03; // TODO remover

            // TODO TESTAR COM ISSO AGORA
            [
                "items"=>[],
                "customer"=>[],
                "payments"=> [
                    [   
                        "amount" => 2,
                        "payment_method"=>"checkout",
                        "checkout"=> [
                            "expires_in"=>240,
                            "billing_address_editable" => false,
                            "customer_editable" => true,
                            "accepted_payment_methods"=> ['credit_card', 'debit_card', 'boleto', 'bank_transfer', 'pix'],
                            "success_url"=> "https://www.pagar.me", // TODO corrigir para nossa rota
                            "credit_card"=> [],
                        ],
                    ],
                ]
            ];
            
            // TODO corrigir atribuição de valores dos parâmetros
            
            // https://docs.pagar.me/reference#checkout-pagarme
            $client = new Client(config('app.pagar_me_api_token'));
            $transaction = $client->transactions()->create(
                [
                    "items"=>[],
                    "customer"=>[],
                    "payments"=> [
                        [   
                            "amount" => 2,
                            "payment_method"=>"checkout",
                            "checkout"=> [
                                "expires_in"=>240,
                                "billing_address_editable" => false,
                                "customer_editable" => true,
                                "accepted_payment_methods"=> ['credit_card', 'debit_card', 'boleto', 'bank_transfer', 'pix'],
                                "success_url"=> "https://www.pagar.me", // TODO corrigir para nossa rota
                                "credit_card"=> [],
                            ],
                        ],
                    ]
                ]
            );
            dd($transaction);
            $transaction = $client->transactions()->create([
                // 'currency' => 'BRL',
                // 'closed' => true,
                'amount' => $totalValue,
                "checkout" => [
                    "expires_in" =>120,
                    "billing_address_editable"  => false,
                    "customer_editable"  => true,
                    "accepted_payment_methods" => ["credit_card"],
                    "success_url" => "https =>//www.pagar.me",
                    "credit_card" => []
                ],
                //payment_method	
                //string	Meio de pagamento. 
                //Valores possíveis: credit_card,debit_card, 
                //boleto, voucher, bank_transfer, safety_pay, checkout, cash, pix.
                'payment_method' => 'checkout',
                'card_holder_name' => 'TESTE TESTE DO TESTE',
                'card_cvv' => '123',
                'card_number' => '123412341234',
                'card_expiration_date' => '03/2020',
                'customer' => [
                    'external_id' => '1',
                    'name' => 'Teset teste',
                    'email' => $customer->email,
                    'type' => 'individual', // TODO corrigir
                    'country' => 'br',
                    'documents' => [
                        [
                            'type' => 'CPF',
                            'number' => '15979545786',
                        ],
                    ],
                    'phone_numbers' => ['+5527998393682']
                ],
                'billing' => [
                    'name' => 'Endereco de Teste',
                    'address' => [
                      'country' => 'br',
                      'street' => $address->street,
                      'street_number' => $address->number,
                      'state' => $address->state,
                      'city' => $address->city,
                      'neighborhood' => $address->district,
                      'zipcode' => getOnlyNumber($address->postal_code),
                    ]
                ],
                'shipping' => [
                    'name' => $shippingDetails['description'],
                    'fee'=> $shippingDetails['value'],
                    // 'delivery_date' => $shippingDetails['deadline'],
                    'delivery_date' => '2020-01-01',
                    'expedited' => true,
                    'address' => [
                      'country' => 'br',
                      'street' => $address->street,
                      'street_number' => $address->number,
                      'state' => $address->state,
                      'city' => $address->city,
                      'neighborhood' => $address->district,
                      'zipcode' => getOnlyNumber($address->postal_code),
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
                'items' => [
                    [
                        'id' => '1',
                        'title' => 'asdas',
                        'unit_price' => 2,
                        'quantity' => 1,
                        'tangible' => true,
                    ],
                ],
            ]);
            dd($transaction);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);

            return redirect()
                ->route('cart')
                ->withErrors($e->getMessage());
        }

        dd('deu certo');

        // TODO retornar para essa rota -> $redirectUrl

        // return redirect()->route('panel.order.show', $order->id)->withSuccess('Você está quase! Efetue o pagamento para iniciarmos a separação do seu pedido :)');
    }
}