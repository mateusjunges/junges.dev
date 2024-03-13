<?php

declare(strict_types=1);

namespace App\Modules\Blog\Routing\Registrars;

use App\Contracts\RouteRegistrar;
use App\Modules\Blog\Http\Controllers\Links\IndexController;
use App\Modules\Blog\Http\Controllers\Links\LinkApproval;
use App\Modules\Blog\Http\Controllers\Links\LinkController;
use Illuminate\Contracts\Routing\Registrar;

final class LinksRouteRegistrar implements RouteRegistrar
{
    public function map(Registrar $router): void
    {
        $router->group(
            attributes: [
                'prefix' => 'links',
                'middleware' => ['web', 'signed'],
            ],
            routes: function (Registrar $router) {
                $router->get(
                    uri: '/{link}/approve',
                    action: [LinkApproval::class, 'approve']
                )->name('link.approve');

                $router->get(
                    uri: '/{link}/approve-and-create-post',
                    action: [LinkApproval::class, 'approveAndCreatePost']
                )->name('link.approve-and-create-post');

                $router->get(
                    uri: '/{link}/reject',
                    action: [LinkApproval::class, 'reject']
                )->name('link.reject');
            }
        );

        $router->group(
            attributes: [
                'middleware' => ['web', 'auth', 'verified', 'doNotCacheResponse'],
            ],
            routes: function (Registrar $router) {
                $router->get(
                    uri: '/links',
                    action: IndexController::class,
                )->name('links.index');

                $router->get(
                    uri: '/links/create',
                    action: [LinkController::class, 'create']
                )->name('links.create');

                $router->post(
                    uri: '/links',
                    action: [LinkController::class, 'store']
                )->name('links.store');

                $router->view('thanks', 'front.links.thanks')->name('links.thanks');
            },
        );
    }
}
