<?php

declare(strict_types=1);

namespace App\Modules\Docs\Routing\Registrars;

use App\Contracts\RouteRegistrar;
use App\Modules\Docs\Http\Controllers\DocsController;
use App\Modules\Docs\Http\Controllers\Webhooks\HandleGithubRepoForkedWebhookController;
use App\Modules\Docs\Http\Controllers\Webhooks\HandleGithubRepositoryWebhookController;
use App\Modules\Docs\Http\Controllers\Webhooks\HandleGithubStarWebhookController;
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
                $router->get('/', [DocsController::class, 'index'])->name('index');
                $router->get('{repository}/{alias?}', [DocsController::class, 'repository'])->name('repository');
                $router->get('{repository}/{alias}/{slug}', [DocsController::class, 'show'])->where('slug', '.*')->name('page');
            },
        );

        $router->group(
            attributes: [
                'prefix' => 'api/webhooks/github',
                'as' => 'api.docs.webhooks.github.',
                'middleware' => ['api'],
            ],
            routes: static function (Registrar $router) {
                $router->post('/', [HandleGithubRepositoryWebhookController::class, 'handle'])->name('repository');
                $router->post('repo-starred', [HandleGithubStarWebhookController::class, 'handle'])->name('repo-starred');
                $router->post('repo-forked', [HandleGithubRepoForkedWebhookController::class, 'handle'])->name('repo-forked');
            },
        );
    }
}
