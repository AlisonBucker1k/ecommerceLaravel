<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductVariation;
use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * Display the home page.
     *
     * @return View
     */
    public function index()
    {
        $limit = 16;

        $product = new Product();
        $data['products_highlighted'] = $product->highlightedProducts()->limit($limit)->get();

        $productVariation = new ProductVariation();
        $data['products_promotion'] = $productVariation->variationsOnSale()
            ->orderBy('discount_percent', 'DESC')
            ->limit($limit)
            ->get();
        $data['activeProducts'] = $product->activeProducts($limit);

        return view('site.home', $data);
    }

    /**
     * Display about page.
     *
     * @return View
     */
    public function about() {
        return view('site.about');
    }
}
