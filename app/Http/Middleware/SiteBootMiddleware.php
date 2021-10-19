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
        app('view')->share('categoriesWithProduct', $category->getCategoriesWithProduct());
        app('view')->share('categories', $category->activeCategories());

        $customerId = auth()->id();
        $cart = Cart::getCart($customerId, Cookie::get('cart_token'));
        app('view')->share('totalCartQuantity', $cart->totalProducts());
        app('view')->share('cartProducts', $cart->cartProducts);
        app('view')->share('cartTotalValue', $cart->total_value_formated);

        return $next($request);
    }
}
