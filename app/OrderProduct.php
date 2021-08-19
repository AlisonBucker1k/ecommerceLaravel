<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Exception;

class OrderProduct extends Model
{
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function variation()
    {
        return $this->belongsTo('App\ProductVariation', 'product_variation_id');
    }

    public function items()
    {
        return $this->hasMany('App\OrderProductVariationItem', 'order_product_id');
    }

    public function getValueFormatedAttribute()
    {
        return currencyFloat2Brl($this->value);
    }

    public function getFinalValueFormatedAttribute()
    {
        return currencyFloat2Brl($this->final_value);
    }

    public function getSubtotalValueFormatedAttribute()
    {
        return currencyFloat2Brl($this->subtotal_value);
    }

    public function addOrderProducts(Cart $cart, $orderId)
    {
        $cartProducts = $cart->cartProducts()->get();
        foreach ($cartProducts as $cartProduct) {
            $variation = $cartProduct->variation;
            $product = $cartProduct->product;

            if (!ProductVariation::checkAvailable($variation)) {
                throw new Exception('O produto ' . $product->name . ' não está mais disponível');
            }

            if ($variation->stock_quantity < $cartProduct->quantity) {
                throw new Exception('O produto ' . $product->name . ' não possui o estoque disponível para essa quantidade');
            }

            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $orderId;
            $orderProduct->product_id = $product->id;
            $orderProduct->product_variation_id = $cartProduct->product_variation_id;
            $orderProduct->value = $variation->value;
            $orderProduct->final_value = $variation->final_price;
            $orderProduct->subtotal_value = $cartProduct->quantity * $variation->final_price;
            $orderProduct->discount_percent = $variation->discount_percent;
            $orderProduct->promotion_value = $variation->promotion_value;
            $orderProduct->quantity = $cartProduct->quantity;
            $orderProduct->name = $product->name;
            $orderProduct->description = $product->description;
            $orderProduct->image = $variation->image;
            $orderProduct->save();

            $orderProductVariationItem = new OrderProductVariationItem();
            $orderProductVariationItem->addProductVariationItem($orderProduct);

            $variation->withdrawStock($cartProduct->quantity);

            $cartProduct->delete();
        }
    }
}