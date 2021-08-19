<?php

namespace App;

use App\Enums\ProductStatus;
use App\Enums\ProductVariationMain;
use App\Enums\ProductVariationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Exception;

class ProductVariation extends Model
{
    public function getStatusDescriptionAttribute()
    {
        return ProductVariationStatus::getDescription($this->status);
    }

    public function getValueFormatedAttribute()
    {
        return currencyFloat2Brl($this->value);
    }

    public function getPromotionValueFormatedAttribute()
    {
        return currencyFloat2Brl($this->promotion_value);
    }

    public function getFinalPriceAttribute()
    {
        if ($this->discount_percent > 0) {
            return $this->promotion_value;
        }

        return $this->value;
    }

    public function getFinalPriceFormatedAttribute()
    {
        return currencyFloat2Brl($this->final_price);
    }

    public function getValueSavingFormatedAttribute()
    {
        return currencyFloat2Brl($this->value_saving);
    }

    public function getValueSavingAttribute()
    {
        return $this->value - $this->promotion_value;
    }

    public function getCostValueFormatedAttribute()
    {
        return currencyFloat2Brl($this->cost_value);
    }

    public function getImageAttribute()
    {
        return $this->getImage();
    }

    public function activeVariations()
    {
        return $this->where('status', ProductVariationStatus::ACTIVE)->get();
    }

    public function availableVariation()
    {
        return $this->query()
            ->where('product_variations.stock_quantity', '>', 0)
            ->where('product_variations.status', ProductVariationStatus::ACTIVE);
    }

    public static function checkAvailable($variation)
    {
        if (
            $variation->product->status == ProductStatus::ACTIVE &&
            $variation->stock_quantity > 0 &&
            $variation->status == ProductVariationStatus::ACTIVE
        ) {
            return true;
        }

        return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function variationsOnSale()
    {
        return $this->availableVariation()
            ->select('product_variations.*')
            ->join('products', 'products.id', '=', 'product_variations.product_id')
            ->where('products.status', '=', ProductStatus::ACTIVE)
            ->where('discount_percent', '>', 0);
    }

    public function variationImage()
    {
        $productImage = new ProductImage();

        return $productImage->getVariationImage($this->id);
    }

    public function getImage()
    {
        $image = '/assets/img/no-image.jpg';

        $variationImage = $this->variationImage();
        if (empty($variationImage->file)) {
            $productImage = new ProductImage();
            $variationImage = $productImage->getMainImage($this->product_id);
        }

        if (!empty($variationImage->file)) {
            $image = $variationImage->file;
        }

        return $image;
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function items()
    {
        return $this->hasMany('App\ProductVariationItem');
    }

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function saveProductVariation(array $data)
    {
        if (empty($this->id)) {
            $this->product_id = $data['product_id'];

            $exists = ProductVariation::where('product_id', $this->product_id)->exists();
            $this->main = ($exists ? ProductVariationMain::NO : ProductVariationMain::YES);
        }

        $this->value = currencyBrl2Float($data['value']);
        $this->cost_value = currencyBrl2Float($data['cost_value']);
        $this->promotion_value = currencyBrl2Float($data['promotion_value']);
        $this->discount_percent = currencyBrl2Float($data['discount_percent']);

        if($this->discount_percent > 0) {
            $this->promotion_value = $this->promotionValue($this->discount_percent, $this->value);
        } elseif ($this->promotion_value > 0) {
            $this->discount_percent = $this->percentDiscount($this->promotion_value, $this->value);
        }

        $this->stock_quantity = (int) $data['stock_quantity'];
        $this->width = !empty($data['width']) ? $data['width'] : null;
        $this->height = !empty($data['height']) ? $data['height'] : null;
        $this->weight = !empty($data['weight']) ? $data['weight'] : null;
        $this->length = !empty($data['length']) ? $data['length'] : null;
        $this->highlighted = $data['highlighted'];
        $this->status = $data['status'];
        $this->save();

        return $this;
    }

    public function defineMain()
    {
        $currentMainImage = $this->query()->where([
            'product_id' => $this->product_id,
            'main' => ProductVariationMain::YES
        ]);
        $currentMainImage->update(['main' => ProductVariationMain::NO]);

        $this->main = ProductVariationMain::YES;
        $this->save();
    }

    public function promotionValue($discountPercent, $value)
    {
        return $value - (($value / 100) * $discountPercent);
    }

    public function percentDiscount($promotionValue, $value)
    {
        return 100 - (($promotionValue / $value) * 100);
    }

    public function remove()
    {
        $v = Validator::make([], []);
        if ($this->main === ProductVariationMain::YES) {
            $v->errors()->add('variation', 'Não é possível remover a variação principal');
            throw new ValidationException($v);
        }

        $exists = OrderProduct::query()->where('product_variation_id', $this->id)->exists();
        if ($exists) {
            $v->errors()->add('variation', 'Não é possível remover a variação com pedido vinculado');
            throw new ValidationException($v);
        }

        $this->delete();
    }

    public function totalStock(int $productId)
    {
        return $this->query()
            ->where('product_id', $productId)
            ->where('status', ProductVariationStatus::ACTIVE)
            ->sum('stock_quantity');
    }

    public function getVariationForItems(int $productId, array $variations)
    {
        $query = $this->query()
            ->select(['product_variations.*', DB::raw('COUNT(product_variations.id) total')])
            ->join('product_variation_items', 'product_variation_items.product_variation_id', '=', 'product_variations.id')
            ->groupBy('product_variations.id')
            ->orderBy('total', 'DESC')
            ->limit(1);

        foreach ($variations as $productGridId => $gridVariationId) {
            if (empty($gridVariationId)) {
                return false;
            }

            $query->orWhere(function($query) use ($productId, $productGridId, $gridVariationId){
                $query->where('product_variations.product_id', $productId)
                    ->where('product_variation_items.product_grid_id', $productGridId)
                    ->where('product_variation_items.grid_variation_id', $gridVariationId)
                    ->where('product_variations.status', ProductVariationStatus::ACTIVE);
            });
        }

        $variation = $query->first();

        if (empty($variation) || count($variations) != $variation->total) {
            return [];
        }

        return $variation;
    }

    public function getAvailableVariationsFromProduct(int $productId)
    {
        $variations = $this->availableVariation()->where('product_id', $productId)->get();

        return $variations;
    }

    public function withdrawStock($quantity)
    {
        if ($quantity > $this->stock_quantity) {
            throw new Exception('O produto ' . $this->product->name . ' não possui o estoque disponível para essa quantidade');
        }

        $this->stock_quantity = $this->stock_quantity - $quantity;
        $this->save();
    }
}
