<?php declare(strict_types=1);

namespace App\Modules\Documentation\Routing\Registrars;

use App\Contracts\RouteRegistrar;
use App\Modules\Documentation\Http\Controllers\DocsController;
use App\Modules\Documentation\Http\Controllers\Webhooks\HandleGithubRepositoryWebhookController;
use App\Modules\Documentation\Http\Controllers\Webhooks\HandleGithubStarWebhookController;
use Illuminate\Contracts\Routing\Registrar;

final class DocsRouteRegistrar implements RouteRegistrar
{
    public function map(Registrar $router): void
    {
        $router->group(
            attributes: [
                'prefix' => 'documentation',
                'as' => 'docs.',
                'middleware' => ['web'],
            ],
            routes: static function (Registrar $router) {
                $router->get('documentation', [DocsController::class, 'index'])->name('index');
                $router->get('{repository}/{alias?}', [DocsController::class, 'repository'])->name('repository');
                $router->get('{repository}/{alias}/{slug}', [DocsController::class, 'show'])->where('slug', '.*')->name('page');
            },
        );

        $router->group(
            attributes: [
                'prefix' => 'api/webhooks/github',
                'as' => 'api.docs.',
                'middleware' => ['api'],
            ],
            routes: static function (Registrar $router) {
                $router->post('/', HandleGithubRepositoryWebhookController::class);
                $router->post('repo-starred', HandleGithubStarWebhookController::class);
            },
        );
    }
}
