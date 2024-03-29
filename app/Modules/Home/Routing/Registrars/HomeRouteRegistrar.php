<?php

declare(strict_types=1);

namespace App\Modules\Home\Routing\Registrars;

use App\Contracts\RouteRegistrar;
use App\Modules\Home\Http\Controllers\HomeController;
use Illuminate\Contracts\Routing\Registrar;

final class HomeRouteRegistrar implements RouteRegistrar
{
    public function map(Registrar $router): void
    {
        $router->group(
            attributes: [
                'middleware' => ['web'],
            ],
            routes: function (Registrar $router) {
                $router->get('/', HomeController::class)->name('home');
                $router->view('/about', 'front.about')->name('about');
                $router->redirect('/admin', '/admin/posts')->name('admin');
            }
        );
    }
}
