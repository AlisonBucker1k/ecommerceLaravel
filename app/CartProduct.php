<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    public function cart()
    {
        return $this->belongsTo('App\Cart');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function variation()
    {
        return $this->belongsTo('App\ProductVariation', 'product_variation_id');
    }

    public function getSubtotalValueAttribute()
    {
        return $this->variation->final_price * $this->quantity;
    }

    public function getSubtotalValueFormatedAttribute()
    {
        return currencyFloat2Brl($this->subtotal_value);
    }

    /**
     * @param int $cartId
     * @param Product $product
     * @param ProductVariation $productVariation
     */
    public function addProduct(int $cartId, Product $product, ProductVariation $productVariation)
    {
        $findCartProduct = $this->query()->where([
            'cart_id' => $cartId,
            'product_id' => $product->id,
            'product_variation_id' => $productVariation->id
        ]);

        if ($findCartProduct->exists()) {
            return;
        }

        $this->cart_id = $cartId;
        $this->product_id = $product->id;
        $this->quantity = 1;
        $this->product_variation_id = $productVariation->id;
        $this->save();
    }

    public function increaseQuantity()
    {
        $this->quantity += 1;
        $this->save();
    }

    public function decreaseQuantity()
    {
        if ($this->quantity == 0) {
            return ;
        }

        $this->quantity -= 1;
        $this->save();
    }
}
