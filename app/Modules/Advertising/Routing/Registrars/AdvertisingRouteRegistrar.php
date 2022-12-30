<?php declare(strict_types=1);

namespace App\Modules\Advertising\Routing\Registrars;

use App\Contracts\RouteRegistrar;
use App\Modules\Advertising\Http\Controllers\HandleSponsorshipWebhookController;
use Illuminate\Contracts\Routing\Registrar;

final class AdvertisingRouteRegistrar implements RouteRegistrar
{
    public function map(Registrar $router): void
    {
        $router->group(
            attributes: [
                'middleware' => ['web']
            ],
            routes: function (Registrar $router) {
                $router->view('advertising', 'front.advertising')
                    ->name('advertising.index');
            }
        );

        $router->group(
            attributes: [
                'middleware' => ['web', 'api'],
                'prefix' => 'api/advertising/webhooks/github',
                'as' => 'api.advertising.webhooks.github.',
            ],
            routes: function (Registrar $router) {
                $router->post('/sponsors', [HandleSponsorshipWebhookController::class, 'handle'])->name('sponsors');
            }
        );
    }
}
