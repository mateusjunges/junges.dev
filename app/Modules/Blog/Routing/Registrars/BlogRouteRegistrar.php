<?php

declare(strict_types=1);

namespace App\Modules\Blog\Routing\Registrars;

use App\Contracts\RouteRegistrar;
use App\Modules\Blog\Http\Controllers\OgImageController;
use App\Modules\Blog\Http\Controllers\ShowPostController;
use Illuminate\Contracts\Routing\Registrar;

final class BlogRouteRegistrar implements RouteRegistrar
{
    public function map(Registrar $router): void
    {
        $router->group(
            attributes: [
                //                'as' => 'blog.',
                'middleware' => ['web'],
            ],
            routes: function (Registrar $router) {
                $router->get('{post}/og-image', OgImageController::class)->name('post.ogImage');
                $router->get('{postSlug}', ShowPostController::class)->name('post');
            }
        );
    }
}
