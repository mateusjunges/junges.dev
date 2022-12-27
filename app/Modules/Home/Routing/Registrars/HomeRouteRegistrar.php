<?php declare(strict_types=1);

namespace App\Modules\Home\Routing\Registrars;

use App\Contracts\RouteRegistrar;
use App\Modules\Home\Http\Controllers\HomeController;
use Illuminate\Contracts\Routing\Registrar;

final class HomeRouteRegistrar implements RouteRegistrar
{
    public function map(Registrar $router): void
    {
        $router->get('/', HomeController::class)->name('home');
        $router->view('/test', 'test');
    }
}
