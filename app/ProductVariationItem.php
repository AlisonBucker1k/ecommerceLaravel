<?php

namespace App;

use App\Enums\ProductVariationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductVariationItem extends Model
{
    protected $fillable = ['product_variation_id', 'product_grid_id', 'grid_variation_id'];

    public function variation()
    {
        return $this->belongsTo('App\ProductVariation', 'product_variation_id');
    }

    public function productGrid()
    {
        return $this->belongsTo('App\ProductGrid');
    }

    public function gridVariation()
    {
        return $this->belongsTo('App\GridVariation');
    }

    public function checkExistsVariations(array $variations, $productId, $variationId = null)
    {
        $totalVariations = count($variations);
        $productGrids = Product::find($productId)->grids()->get();

        $query = ProductVariationItem::query()
            ->select(DB::raw('COUNT(1) total'))
            ->join('product_variations', 'product_variations.id', '=', 'product_variation_id');

        foreach ($productGrids as $grid) {
            if (!isset($variations[$grid->id])) {
                return false;
            }

            $groupWhere = function ($query) use ($productId, $grid, $variations, $variationId) {
                $query->where('product_variations.product_id', $productId)
                    ->where('product_grid_id', $grid->id)
                    ->where('grid_variation_id', $variations[$grid->id]);
                if (!empty($variationId)) {
                    $query->where('product_variation_id', '!=', $variationId);
                }
            };
            $query->orWhere($groupWhere);
        }

        return $query->groupBy('product_variation_id')
            ->having('total', $totalVariations)
            ->limit(1)
            ->exists();
    }

    public function saveItem(int $productVariationId, int $productGridId, int $gridVariationId)
    {
        $this->query()->updateOrCreate([
            'product_variation_id' => $productVariationId,
            'product_grid_id' => $productGridId
        ], [
            'grid_variation_id' => $gridVariationId
        ]);
    }

    public function productVariationExists($productVariationId, $productGridId, $gridVariationId)
    {
        return $this->query()->where([
            'product_variation_id' => $productVariationId,
            'product_grid_id' => $productGridId,
            'grid_variation_id' => $gridVariationId
        ])->exists();
    }

    public function getVariationsAvailable($productGridId, $gridVariationId = null)
    {
        $query = $this->query()->distinct();
        if (!empty($gridVariationId)) {
            $query = $this->query()->select('product_variation_items.product_variation_id');
        }

        $variations = $query->addSelect(['grid_variations.id', 'grid_variations.description', 'grid_variations.grid_id'])
            ->join('product_variations', 'product_variations.id', '=', 'product_variation_items.product_variation_id')
            ->join('grid_variations', 'grid_variations.id', '=', 'product_variation_items.grid_variation_id')
            ->where('product_variation_items.product_grid_id', $productGridId)
            ->where('product_variations.status', ProductVariationStatus::ACTIVE)
            ->where('product_variations.stock_quantity', '>', 0)
            ->orderBy('grid_variations.description')
            ->get();

        if (empty($gridVariationId)) {
            return $variations;
        }

        $aux = [];
        foreach ($variations as $variation) {
            if (!isset($aux[$variation->id])) {
                $exists = $this->query()
                    ->where([
                        'product_variation_id' => $variation->product_variation_id,
                        'grid_variation_id' => $gridVariationId
                    ])
                    ->exists();
                if ($exists) {
                    $aux[$variation->id] = $variation;
                }
            }
        }

        return $aux;
    }

    public function getVariationItems($variationId)
    {
        $items = $this->query()
            ->select(['product_variation_items.*', 'grid_variations.description', 'grid_variations.grid_id', DB::raw('grids.description grid_description')])
            ->join('grid_variations', 'grid_variations.id', '=', 'product_variation_items.grid_variation_id')
            ->join('grids', 'grids.id', '=', 'grid_variations.grid_id')
            ->where('product_variation_items.product_variation_id', '=', $variationId)
            ->get();
        $aux = [];
        foreach ($items as $item) {
            $aux[$item->grid_id] = $item;
        }

        return $aux;
    }
}
