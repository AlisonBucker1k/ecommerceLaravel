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
            $customer = auth()->user();

            // Antes:
            // $order = new Order();
            // $order->createOrder($customer, $addressId, $shippingId);

            // TODO usar classe /Payments/PagarMe/Order/CreateOrder
            // $order = new OrderOrder($customer);
            // $redirectUrl = $order->create($request->post());

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
    
            $cart = Cart::getCart($customer->id);
            if ($cart->totalProducts() <= 0) {
                throw new Exception('Adicione um produto no carrinho efetuar a compra');
            }
    
            $address = Address::query()->where(['customer_id' => $customer->id, 'id' => $params->address_id])->first();
    
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
                    'external_id' => $customer->id,
                    'name' => $customer->name,
                    'type' => 'individual', // TODO corrigir
                    'country' => $customer->country,
                    'documents' => [
                      [
                        'type' => $customer->amount,
                        'number' => $customer->amount,
                      ]
                    ],
                    'phone_numbers' => [ $customer->phone ],
                    'email' => $customer->email,
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