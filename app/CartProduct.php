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

    public function addProduct(int $cartId, Product $product, ProductVariation $productVariation, $quantity)
    {
        $findCartProduct = $this
            ->query()
            ->where([
                'cart_id' => $cartId,
                'product_id' => $product->id,
                'product_variation_id' => $productVariation->id,
            ])
            ->first();

        if (empty($findCartProduct)) {
            $findCartProduct = new CartProduct();
        }

        $findCartProduct->cart_id = $cartId;
        $findCartProduct->product_id = $product->id;
        $findCartProduct->quantity += $quantity;
        $findCartProduct->product_variation_id = $productVariation->id;
        $findCartProduct->save();
    }

    public function changeQuantity($newValue)
    {
        if ($newValue <= 0) {
            return $this->delete();
        }

        $this->quantity = $newValue;
        $this->save();
    }
}
