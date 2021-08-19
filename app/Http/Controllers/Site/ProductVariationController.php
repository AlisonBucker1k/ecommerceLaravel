<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use App\ProductVariation;
use App\Subcategory;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    public function variations(Request $request, Category $category, Subcategory $subcategory, Product $product)
    {
        $productGridId = $request->get('product_grid_id');
        $variationId = $request->get('variation_id');

        $grids = $product->getGridsWithVariationsAvailable($product->id, $productGridId, $variationId);

        return ['grids' => $grids];
    }

    public function find(Request $request, Category $category, Subcategory $subcategory, Product $product)
    {
        $variations = $request->get('variation');

        $productVariation = new ProductVariation();
        $findVariation = $productVariation->getVariationForItems($product->id, $variations);
        if (empty($findVariation)) {
            return [];
        }

        $value = $findVariation->value_formated;
        $promotionValue = null;
        $diffValue = null;
        if ($findVariation->promotion_value > 0) {
            $promotionValue = $findVariation->promotion_value_formated;
            $diffValue = $findVariation->value_saving_formated;
        }

        $productImage = new ProductImage();
        $variation = [
            'id' => $findVariation->id,
            'image' => $productImage->getVariationImage($findVariation->id),
            'value' => $value,
            'promotion_value' => $promotionValue,
            'diff_value' => $diffValue
        ];

        return ['variation' => $variation];
    }
}