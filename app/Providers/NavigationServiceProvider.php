<?php

namespace App\Providers;
;

use App\Modules\Auth\Http\Controllers\LoginController;
use App\Modules\Home\Http\Controllers\HomeController;
use Illuminate\Support\ServiceProvider;
use Spatie\Menu\Laravel\Menu;

class NavigationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Menu::macro('primary', function () {
            return Menu::new()
                ->route('docs.index', 'Docs')
                ->action(HomeController::class, 'Home')
                ->link('/about', 'About')
                ->setActiveFromRequest();
        });

        Menu::macro('secondary', function () {
            $menu = Menu::new()
                ->addClass('space-y-2')
                ->url('advertising', 'Advertising')
                ->route('links.index', 'Links')
                ->setActiveFromRequest();

            if (auth()->check()) {
                $menu->action([LoginController::class, 'logout'], 'Logout');
            } else {
                $menu->action([LoginController::class, 'showLoginForm'], 'Login');
            }

            return $menu;
        });
    }
}
