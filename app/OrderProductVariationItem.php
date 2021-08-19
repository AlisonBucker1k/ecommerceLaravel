<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProductVariationItem extends Model
{
    public function orderProduct()
    {
        return $this->belongsTo('App\OrderProduct');
    }

    public function item()
    {
        return $this->belongsTo('App\ProductVariationItem', 'product_variation_item_id');
    }

    public function gridVariation()
    {
        return $this->belongsTo('App\GridVariation');
    }

    public function addProductVariationItem(OrderProduct $orderProduct)
    {
        foreach ($orderProduct->variation->items as $item) {
            $orderProductVariationItem = new OrderProductVariationItem();
            $orderProductVariationItem->order_product_id = $orderProduct->id;
            $orderProductVariationItem->product_variation_item_id = $item->id;
            $orderProductVariationItem->grid_description = $item->productGrid->grid->description;
            $orderProductVariationItem->grid_variation_description = $item->gridVariation->description;
            $orderProductVariationItem->save();
        }
    }
}