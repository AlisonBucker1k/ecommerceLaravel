<?php

namespace App\Http\Controllers\Site;

use App\Enums\HighLightedProduct;
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
            ->where('products.highlighted', HighLightedProduct::NOT)
            ->get();

        return view('site.home', $data);
    }

    public function about()
    {
        return view('site.about');
    }

    public function terms()
    {
        return view('site.terms');
    }

    public function helpChannels()
    {
        return view('site.help_channels');
    }

    public function privacy()
    {
        return view('site.privacy');
    }

    public function shipping()
    {
        return view('site.shipping');
    }

    public function exchange()
    {
        return view('site.exchange');
    }
}
