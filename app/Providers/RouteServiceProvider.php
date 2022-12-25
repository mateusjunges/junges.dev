<?php

namespace App\Providers;

use App\Concerns\MapRouteRegistrars;
use App\Modules\Blog\Routing\Registrars\BlogRouteRegistrar;
use App\Modules\Documentation\Routing\Registrars\DocsRouteRegistrar;
use App\Modules\Home\Routing\Registrars\HomeRouteRegistrar;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
class RouteServiceProvider extends ServiceProvider
{
    use MapRouteRegistrars;
    public const HOME = '/home';

    /** @var array<int, class-string> $registrars */
    private static array $registrars = [
        DocsRouteRegistrar::class,
        HomeRouteRegistrar::class,
        BlogRouteRegistrar::class,
    ];

    /** Define your route model bindings, pattern filters, etc.*/
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(
            routesCallback: fn (Registrar $router) => $this->mapRoutes($router, self::$registrars)
        );
    }

    /** Configure the rate limiters for the application.*/
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
