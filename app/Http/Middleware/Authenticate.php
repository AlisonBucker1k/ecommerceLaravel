<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Cookie;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|void
     */
    protected function redirectTo($request)
    {
        //TODO testar para ver se é isso que está fazendo com que o redirecionamento
        // na criação de conta não esteja rolando

        if (!$request->expectsJson()) {
            Cookie::queue('redirectTo', url()->current(), 60);

            return route('login');
        }
    }
}
