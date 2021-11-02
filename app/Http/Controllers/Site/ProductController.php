<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Enums\ProductStatus;
use App\Enums\ProductVariationMain;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductVariation;
use App\ProductVariationItem;
use App\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, Category $category, Subcategory $subcategory)
    {
        $product = new Product();
        $query = $product->availableProducts();
        $filters = $this->filters($query, $request, $category, $subcategory);

        $products = $query
            ->where('products.status', ProductStatus::ACTIVE)
            ->paginate(30);

        if(count($products) == 0){
            return redirect()->back()->with('error', 'Não existe produtos nessa categoria');
        }

        $data['products'] = $products;
        $data['filters'] = $filters;
        $data['category'] = $category;
        $data['subcategory'] = $subcategory;
        $data['breadcrumb'] = $this->handleBreadcrumb($category, $subcategory);

        return view('site.product.products', $data);
    }

    private function handleBreadcrumb(Category $category, Subcategory $subcategory)
    {
        $breadcrumb['Produtos'] = route('products');
        if (!empty($category->name)) {
            $breadcrumb[$category->name] = route('products', [$category->slug]);
        }

        if (!empty($subcategory->name)) {
            $breadcrumb[$subcategory->name] = route('products', [$category->slug, $subcategory->slug]);
        }

        return $breadcrumb;
    }

    public function show(Product $product, ProductVariation $productVariation)
    {
        if ($product->has_grid_variation) {
            $product->variation = $productVariation;
            if (!$productVariation->exists) {
                $product->variation = $product->mainVariation()->first();
            }

            $productVariationItem = new ProductVariationItem();
            $product->variation->items = $productVariationItem->getVariationItems($product->variation->id);
        }

        $data['grids'] = $product->getGridsWithVariationsAvailable($product->id);
        $data['product'] = $product;
        $data['total_stock'] = $product->totalStock();

        return view('site.product.product', $data);
    }

    private function filters(Builder &$query, Request $request, Category $category, Subcategory $subcategory)
    {
        if (!empty($request->order)) {
            if ($request->order == 'recents') {
                $query->orderBy('products.updated_at', 'desc');
            }
        } else {
            $query->orderBy('products.id', 'desc');
        }

        if (!empty($request->search_term)) {
            $query->where('products.name', 'like', "%$request->search_term%");
        }

        if (!empty($request->category)) {
            $query->where('products.category_id', $category->id);
        }

        if (!empty($request->subcategory)) {
            $query->where('products.subcategory_id', $subcategory->id);
        }

        if (!empty($request->product_name)) {
            $query->where('products.name', 'like', "%$request->product_name%");
        }

        if (!empty($request->start_value) || !empty($request->end_value)) {
            $productVariation = new ProductVariation();
            $variations = $productVariation
                ->availableVariation()
                ->where('product_variations.main', '=', ProductVariationMain::YES);

            $query->joinSub($variations, 'product_variations', function ($join) {
                $join->on('product_variations.product_id', '=', 'products.id');
            });
        }

        if (!empty($request->start_value)) {
            $startValue = $request->start_value;
            $query->where(function($query) use ($startValue) {
                $query->where(function($query) use ($startValue) {
                    $query->where('product_variations.value', '>=', currencyBrl2Float($startValue));
                    $query->where('product_variations.promotion_value', '<=', 0);
                });

                $query->orWhere('product_variations.promotion_value', '>=', currencyBrl2Float($startValue));
            });
        }

        if (!empty($request->end_value)) {
            $endValue = $request->end_value;
            $query->where(function($query) use ($endValue) {
                $query->where(function($query) use ($endValue) {
                    $query->where('product_variations.value', '<=', currencyBrl2Float($endValue));
                    $query->where('product_variations.promotion_value', '<=', 0);
                });

                $query->orWhere('product_variations.promotion_value', '<=', currencyBrl2Float($endValue));
            });
        }

        return $request;
    }
}
