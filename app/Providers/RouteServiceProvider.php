<?php

namespace App\Providers;

use App\Concerns\MapRouteRegistrars;
use App\Modules\Advertising\Routing\Registrars\AdvertisingRouteRegistrar;
use App\Modules\Auth\Routing\Registrars\AuthRouteRegistrar;
use App\Modules\Blog\Models\Post;
use App\Modules\Blog\Routing\Registrars\BlogRouteRegistrar;
use App\Modules\Blog\Routing\Registrars\LinksRouteRegistrar;
use App\Modules\Docs\Routing\Registrars\DocsRouteRegistrar;
use App\Modules\Home\Routing\Registrars\HomeRouteRegistrar;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    use MapRouteRegistrars;

    /** @var array<class-string> $registrars  */
    private array $registrars = [
        HomeRouteRegistrar::class,
        LinksRouteRegistrar::class,
        DocsRouteRegistrar::class,
        AuthRouteRegistrar::class,
        AdvertisingRouteRegistrar::class,
        BlogRouteRegistrar::class, // This MUST be the last one because of wildcard routes
    ];

    public function boot()
    {
        parent::boot();

        $this->routes(
            routesCallback: fn (Registrar $router) => $this->mapRoutes($router, $this->registrars)
        );

        $this->registerRouteModelBindings();
    }


    public function registerRouteModelBindings(): void
    {
        Route::bind('postSlug', function ($slug) {
            /** @var Post $post */
            $post = Post::findByIdSlug($slug);

            if (! $post) {
                abort(404);
            }

            if (auth()->user()?->email === 'mateus@junges.dev') {
                return $post;
            }

            if ($post->preview_secret === request()->get('preview_secret')) {
                return $post;
            }

            if (! $post->published) {
                abort(404);
            }

            return $post;
        });
    }
}
