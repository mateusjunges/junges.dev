<?php declare(strict_types=1);

namespace App\Modules\Blog\Routing\Registrars;

use App\Contracts\RouteRegistrar;
use App\Modules\Blog\Http\Controllers\OriginalsController;
use Illuminate\Contracts\Routing\Registrar;

final class BlogRouteRegistrar implements RouteRegistrar
{
    public function map(Registrar $router): void
    {
        $router->group(
            attributes: [
                'prefix' => 'blog',
                'as' => 'blog.',
                'middleware' => ['web'],
            ],
            routes: static function (Registrar $router) {
                $router->get('posts', OriginalsController::class)->name('posts.originals');
            },
        );
    }
}
