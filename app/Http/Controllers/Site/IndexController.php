<?php

namespace App\Http\Controllers\Site;

use App\Enums\HighLightedProduct;
use App\Http\Controllers\Controller;
use App\Mail\OrderStatusUpdate;
use App\Order;
use App\Product;
use App\ProductVariation;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function index()
    {
        $order = Order::find(1);
        Mail::send(new OrderStatusUpdate($order, $order->status, $order->customer->email));

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
}
