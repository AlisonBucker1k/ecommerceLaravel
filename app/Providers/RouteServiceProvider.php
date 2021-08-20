<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapRoutes();
    }

    /**
     * Define the "site" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapRoutes()
    {

        $domain = env('APP_DOMAIN');
        $url = preg_replace('/^http(s|):\/\/(.+?)(\/|$).*/','$2',url()->current());

        switch ($url) {
            case 'admin.' . $domain:
                Route::domain('admin.' . config('app.domain'))
                    ->middleware('web')
                    ->namespace($this->namespace . '\Admin')
                    ->group(base_path('routes/admin.php'));
                break;
            case 'api.' . $domain:
                Route::prefix('api')
                    ->middleware('api')
                    ->namespace($this->namespace)
                    ->group(base_path('routes/api.php'));
                break;
            default:
                Route::domain(config('app.domain'))
                    ->middleware('web')
                    ->namespace($this->namespace . '\Site')
                    ->group(base_path('routes/site.php'));
                break;
        }
    }
}
