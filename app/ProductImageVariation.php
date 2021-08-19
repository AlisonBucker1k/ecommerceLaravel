<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImageVariation extends Model
{
    public function image()
    {
        return $this->belongsTo('App\ProductImage', 'id');
    }

    public function variation()
    {
        return $this->belongsTo('App\ProductVariation', 'id');
    }

    public function linkImage($productImageId, $productVariationId)
    {
        return $this->query()->updateOrInsert([
                'product_variation_id' => $productVariationId
            ], [
                'product_image_id' => $productImageId
            ]);
    }

    public function unlinkImage($productImageId, $productVariationId)
    {
        return $this->query()
            ->where([
                'product_variation_id' => $productVariationId,
                'product_image_id' => $productImageId
            ])
            ->delete();
    }
}
