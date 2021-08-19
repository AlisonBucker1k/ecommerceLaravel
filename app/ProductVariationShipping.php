<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariationShipping extends Model
{
    public function productVariation()
    {
        return $this->belongsTo('App\ProductVariation');
    }

    public function shipping()
    {
        return $this->belongsTo('App\Shipping');
    }

    public static function existsShipping($productVariationId, $shippingId)
    {
        return self::query()
            ->where([
                'product_variation_id' => $productVariationId,
                'shipping_id' => $shippingId
            ])
            ->exists();
    }

    public function createShipping($productVariationId, $shippingId)
    {
        $this->product_variation_id = $productVariationId;
        $this->shipping_id = $shippingId;
        $this->save();
    }

    public function handleShippings($productVariationId, $shippingSelecteds)
    {
        $oldShippings = self::getVariationShippings($productVariationId);
        foreach ($oldShippings as $variationShipping) {
            if (!in_array($variationShipping->shipping_id, $shippingSelecteds)) {
                $variationShipping->delete();
            }
        }

        foreach ($shippingSelecteds as $shippingId) {
            if (!self::existsShipping($productVariationId, $shippingId)) {
                $this->createShipping($productVariationId, $shippingId);
            }
        }
    }

    public static function getVariationShippings($productVariationId)
    {
        return self::query()->where('product_variation_id', $productVariationId)->get();
    }
}
