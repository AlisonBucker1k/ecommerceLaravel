<?php

namespace App\Http\Middleware;

use App\Cart;
use App\Category;
use Closure;
use Illuminate\Support\Facades\Cookie;

class SiteBootMiddleware
{
    public function handle($request, Closure $next)
    {
        $category = new Category();
        $categories = $category->getCategoriesWithProduct();
        app('view')->share('categoriesWithProduct', $categories);

        $customerId = auth()->id();
        $cart = Cart::getCart($customerId, Cookie::get('cart_token'));
        app('view')->share('totalCartQuantity', $cart->totalProducts());

        return $next($request);
    }
}