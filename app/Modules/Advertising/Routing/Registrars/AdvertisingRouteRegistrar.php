<?php declare(strict_types=1);

namespace App\Modules\Advertising\Routing\Registrars;

use App\Contracts\RouteRegistrar;
use Illuminate\Contracts\Routing\Registrar;

final class AdvertisingRouteRegistrar implements RouteRegistrar
{
    public function map(Registrar $router): void
    {
        $router->view('advertising', 'front.advertising')
            ->name('advertising.index');
    }
}
