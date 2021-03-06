<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class CheckLogin
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            Cookie::queue(Cookie::make('redirectTo', route('cart'), 525600));

            return redirect()
                ->route('login')
                ->withErrors('Para efetuar a compra é necessário estar logado.');
        }

        return $next($request);
    }
}
