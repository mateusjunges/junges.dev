<?php

namespace App\Providers;

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpenSourceController;
use App\Http\Controllers\UsesController;
use Illuminate\Support\ServiceProvider;
use Spatie\Menu\Laravel\Menu;

class NavigationServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Menu::macro('primary', function () {
            return Menu::new()
                ->action(HomeController::class, 'Home')
                ->action(OpenSourceController::class, 'Open Source')
                ->action(CommunityController::class, 'Community')
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
