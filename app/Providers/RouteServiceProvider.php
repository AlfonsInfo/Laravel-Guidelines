<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';

    protected $namespace = 'App\Http\Controllers';
    protected $apiNamespace = 'App\Http\Controllers\api';
    protected $apiCustom1 = 'App\Http\Controllers\api\Custom1';
    protected $apiCustom2 = 'App\Http\Controllers\api\Custom2';



    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            //* PPDB Routes
            Route::middleware('api')
            ->prefix('api/custom1')
            ->namespace($this->apiCustom1)
            ->group(base_path('routes/custom/custom1.php'));

            //* Keuangan Routes
            Route::middleware('api')
            ->prefix('api/custom2')
            ->namespace($this->apiCustom2)
            ->group(base_path('routes/custom/custom2.php'));


            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
