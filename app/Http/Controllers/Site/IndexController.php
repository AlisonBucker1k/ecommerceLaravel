<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductVariation;

class IndexController extends Controller
{
    public function index()
    {
        $limit = 16;

        $product = new Product();
        $data['highlightedProducts'] = $product->highlightedProducts()->limit($limit)->get();

        $productVariation = new ProductVariation();
        $data['promotionProducts'] = $productVariation
            ->variationsOnSale()
            ->orderBy('discount_percent', 'DESC')
            ->limit($limit)
            ->get();

        return view('site.home', $data);
    }

    public function about()
    {
        return view('site.about');
    }
}
