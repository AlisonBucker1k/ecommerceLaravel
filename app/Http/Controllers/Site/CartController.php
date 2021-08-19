<?php

namespace App\Http\Controllers\Site;

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
        $addressId = $request->post('address_id');
        $shippingId = $request->post('shipping_id');

        if (empty($addressId)) {
            return redirect()
                ->route('cart.confirm')
                ->withErrors('Endereço inválido.');
        }

        DB::beginTransaction();

        try {
            $customer = auth()->user();

            $order = new Order();
            $order->createOrder($customer, $addressId, $shippingId);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()
                ->route('cart')
                ->withErrors($e->getMessage());
        }

        return redirect()->route('panel.order.show', $order->id)->withSuccess('Você está quase! Efetue o pagamento para iniciarmos a separação do seu pedido :)');
    }
}