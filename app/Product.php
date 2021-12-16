<?php

namespace App;

use App\Enums\ProductImageMain;
use App\Enums\ProductVariationMain;
use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        return $this->where('slug', $value)->first() ?? abort(404);
    }

    public function getStatusDescriptionAttribute()
    {
        return ProductStatus::getDescription($this->status);
    }

    public function getTypeDescriptionAttribute()
    {
        $type = 'Variação Única';
        if ($this->has_grid_variation) {
            $type = 'Com Variações';
        }

        return $type;
    }

    public function getYoutubeThumbAttribute()
    {
        if (empty($this->youtube_url)) {
            return null;
        }

        return 'https://img.youtube.com/vi/' . getIdYoutube($this->youtube_url) . '/hqdefault.jpg';
    }

    public function activeProducts()
    {
        return $this->where('status', 1)->get();
    }

    public function images()
    {
        return $this->hasMany('App\ProductImage')->orderBy('product_images.main', 'DESC');
    }

    public function mainImage()
    {
        return $this->hasOne('App\ProductImage')->where('main', ProductImageMain::YES);
    }

    public function secondImage()
    {
        return $this->hasOne('App\ProductImage')->where('main', ProductImageMain::NO);
    }

    public function variations()
    {
        return $this->hasMany('App\ProductVariation');
    }

    public function variation()
    {
        return $this->hasOne('App\ProductVariation');
    }

    public function mainVariation()
    {
        return $this->variation()->where('main', ProductVariationMain::YES);
    }

    public function availableVariation()
    {
        return (new ProductVariation())
            ->availableVariation()
            ->where('product_id', $this->id)
            ->orderBy('main', 'DESC')
            ->first();
    }

    public function grids()
    {
        return $this->hasMany('App\ProductGrid');
    }

    public function orderProduct()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }

    public function saveProduct(array $data)
    {
        $this->name = $data['name'];
        $this->slug = $this->getUniqueSlug($this->name, $this->id);
        $this->description = $data['description'];
        $this->status = $data['status'];
        $this->category_id = $data['category_id'];
        $this->subcategory_id = $data['subcategory_id'];
        $this->highlighted = $data['highlighted'];
        $this->youtube_url = $data['youtube_url'];

        if (empty($this->id)) {
            $this->has_grid_variation = $data['has_grid_variation'];
        }

        $this->save();

        return $this;
    }

    public function getUniqueSlug($name, $id = null, $count = 0)
    {
        $slug = Str::slug($name, '-');
        if ($count > 0) {
            $slug .= $count;
        }

        $find = $this->query()->where('slug', $slug);
        if (!empty($id)) {
            $find->where('id', '!=', $id);
        }

        $exists = $find->exists();
        if ($exists) {
            return $this->getUniqueSlug($name, $id, ($count+1));
        }

        return $slug;
    }

    public function totalStock()
    {
        $productVariation = new ProductVariation();

        return $productVariation->totalStock($this->id);
    }

    public function getGridsWithVariationsAvailable($productId = null, $gridId = null, $gridVariationId = null)
    {
        $grids = $this->grids()
            ->select(['product_grids.*', 'grids.description'])
            ->join('grids', 'grids.id', '=', 'product_grids.grid_id')
            ->orderBy('grids.description')
            ->where('product_grids.product_id', '=', $productId)
            ->get();

        $productVariationItem = new ProductVariationItem();
        $aux = [];
        foreach ($grids as $grid) {
            if ($grid->id != $gridId) {
                $variations = $productVariationItem->getVariationsAvailable($grid->id, $gridVariationId);
            } else {
                $variations = $productVariationItem->getVariationsAvailable($grid->id);
            }

            $grid->variations = $variations;
            $aux[$grid->id] = $grid;
        }

        return $aux;
    }

    public function availableProducts()
    {
        $products = $this->query()->where('products.status', ProductStatus::ACTIVE);
        $productsNotAvailable = [];
        foreach ($products->get() as $key => $product) {
            $productVariation = new ProductVariation();
            $totalAvailableVariations = $productVariation->getAvailableVariationsFromProduct($product->id)->count();
            if ($totalAvailableVariations === 0) {
                $productsNotAvailable[] = $product->id;
            }
        }

        if (!empty($productsNotAvailable)) {
            $products->whereNotIn('products.id', $productsNotAvailable);
        }

        return $products;
    }

    public function highlightedProducts()
    {
        return $this->availableProducts()->where('highlighted', 1);
    }

    public static function getAleatory($limit = 20)
    {
        return self::query()
            ->where('status', ProductStatus::ACTIVE)
            ->limit($limit)
            ->get()
            ->shuffle();
    }
}
