<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class Cart extends Model
{
    public function getTotalValueAttribute()
    {
        return $this->totalValue();
    }

    public function getTotalValueFormatedAttribute()
    {
        return currencyFloat2Brl($this->total_value);
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function cartProducts()
    {
        return $this->hasMany('App\CartProduct', 'cart_id');
    }

    private static function getCustomerCart($customerId)
    {
        $customerCart =  self::query()
            ->whereNotNull('customer_id')
            ->where('customer_id', $customerId)
            ->first();

        if (empty($customerCart)) {
            return null;
        }

        if (Cookie::get('cart_token') != $customerCart->token) {
            $customerCart->token = self::generateToken();
            $customerCart->save();
        }

        return $customerCart;
    }

    private static function getTokenCart($customerId, $token)
    {
        $tokenCart = self::query()
            ->whereNotNull('token')
            ->where('token', $token)
            ->first();

        if (empty($tokenCart)) {
            return null;
        }

        if (!empty($customerId) && $tokenCart->customer_id != $customerId) {
            self::query()->where('customer_id', $customerId)->delete();

            $tokenCart->customer_id = $customerId;
            $tokenCart->save();
        }

        return $tokenCart;
    }

    private static function generateToken()
    {
        $token = Str::random(15);
        $exists = self::query()->where('token', $token)->exists();
        if ($exists) {
            return self::generateToken();
        }

        Cookie::queue(Cookie::make('cart_token', $token, 525600));

        return $token;
    }

    private static function newCart($customerId)
    {
        $cart = new Cart();
        $cart->token = self::generateToken();
        $cart->customer_id = $customerId;
        $cart->save();

        return $cart;
    }

    /**
     * @param null $customerId
     * @param null $token
     * @return Cart|\Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public static function getCart($customerId = null, $token = null)
    {
        $cart = self::getTokenCart($customerId, $token);
        if (!empty($cart)) {
            return $cart;
        }

        $cart = self::getCustomerCart($customerId);
        if (!empty($cart)) {
            return $cart;
        }

        $cart = self::newCart($customerId);

        return $cart;
    }

    /**
     * @param Product $product
     * @param ProductVariation $productVariation
     */
    public function addProduct(Product $product, ProductVariation $productVariation, $quantity)
    {
        $cart = new CartProduct();
        $cart->addProduct($this->id, $product, $productVariation, $quantity);
    }

    public function totalProducts()
    {
        return $this->cartProducts()->count();
    }

    public function totalValue()
    {
        $value = 0;
        $cartProducts = $this->cartProducts()->get();
        foreach ($cartProducts as $cartProduct) {
            if (ProductVariation::checkAvailable($cartProduct->variation)) {
                $value += $cartProduct->subtotal_value;
            }
        }

        return $value;
    }
}
