<?php

namespace App\Providers;

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\Docs\DocsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpenSourceController;
use App\Http\Controllers\UsesController;
use Illuminate\Support\ServiceProvider;
use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Link;

class NavigationServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Menu::macro('primary', function () {
            return Menu::new()
//                ->action(HomeController::class, 'Home')
                ->add(Link::to(route('docs'), 'Documentations'))
                ->action(OpenSourceController::class, 'Open Source')
//                ->action(CommunityController::class, 'Community')
//                ->add(Link::to(route('blog.index'), 'Blog'))
                ->setActiveFromRequest();
        });

        Menu::macro('navbar', function () {
            return Menu::new()
                ->action(OpenSourceController::class, 'Open Source')
//                ->add(Link::to(route('blog.index'), 'Blog'))
                ->setActiveFromRequest();
        });

        Menu::macro('secondary', function () {
            return Menu::new()
                ->addClass('space-y-2')
                ->action(UsesController::class, 'My Setup')
                ->setActiveFromRequest();
        });
    }
}
