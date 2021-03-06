<?php

namespace App\Http\Controllers\Site;

use App\Cart;
use App\General\Shipping;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\ProductVariation;
use DateInterval;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
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

    public function addProduct(Product $product, Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $variation = ProductVariation::query()->find($request->post('variation_id'));

        $customerId = auth()->id();
        $cart = Cart::getCart($customerId, Cookie::get('cart_token'));
        $cart->addProduct($product, $variation, $request->quantity);

        return redirect()->route('cart')->withSuccess('Produto adicionado com sucesso!');
    }

    public function calculateFreight(Request $request)
    {
        try {
            $customerId = null;
            if (auth()->check()) {
                $customerId = auth()->user()->id;
            }

            $cart = Cart::getCart($customerId, Cookie::get('cart_token'));
            $cep = getOnlyNumber($request->get('cep'));

            $result = (new Shipping())->calculate($cart, $cep);
        } catch (Exception $e) {
            $result = [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($result);
    }

    public function confirmOrder(Request $request)
    {
        $customer = auth()->user();
        $cart = Cart::getCart($customer->id, Cookie::get('cart_token'));
        $this->removeUnavailableProducts($cart, $request);

        if ($cart->cartProducts()->count() === 0) {
            return redirect()->route('cart')->withErrors('Adicione um produto no carrinho.');
        }

        $pagarMeBillExpirationDays = config('app.company_bill_expiration_days');
        $billExpirationDate = (new DateTime())
            ->add(new DateInterval("P{$pagarMeBillExpirationDays}D"))
            ->format('d/m/Y');

        $data = [
            'cart' => $cart,
            'customer' => $customer,
            'addresses' => $customer->activeAddresses,
            'billExpirationDate' => $billExpirationDate,
        ];

        return view('site.cart_confirm', $data);
    }

    private function removeUnavailableProducts(Cart $cart, Request $request)
    {
        foreach ($cart->cartProducts()->get() as $cartProduct) {
            $variation = $cartProduct->variation;
            $product = $cartProduct->product;

            if (!ProductVariation::checkAvailable($variation)) {
                $request->session()->flash('warning', 'O produto ' . $product->name . ' n??o est?? mais dispon??vel');
                $cartProduct->delete();
            }

            if ($variation->stock_quantity < $cartProduct->quantity) {
                $request->session()->flash('warning', 'O produto ' . $product->name . ' n??o possui o estoque dispon??vel para essa quantidade');
                $cartProduct->delete();
            }
        }
    }

    public function createOrder(Request $request)
    {
        $customer = auth()->user();

        DB::beginTransaction();

        try {
            $order = new Order();
            $order->createOrder($customer, $request);

            $response = [
                'error' => false,
                'message' => 'Pedido criado com sucesso!',
                'redirect_url' => route('panel.order.show', $order->id),
            ];

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $response = [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($response);
    }
}
