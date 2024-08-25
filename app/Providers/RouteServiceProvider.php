<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));


            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/product.php'));


            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/user.php'));


            Route::middleware('api') // Admin Panel Urls SHA1 Hash
                ->prefix('api/admin')
                ->group(base_path('routes/admin.php'));


            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/order.php'));


            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/shop.php'));


            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/comment.php'));


            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/like.php'));


            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/message.php'));


            Route::middleware('web')
                ->group(base_path('routes/web.php'));

        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
