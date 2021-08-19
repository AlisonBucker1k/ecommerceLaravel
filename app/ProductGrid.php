<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGrid extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function grid()
    {
        return $this->belongsTo('App\Grid');
    }

    public function createProductGrid($productId, $gridId)
    {
        $this->product_id = $productId;
        $this->grid_id = $gridId;
        $this->save();

        return $this;
    }
}
