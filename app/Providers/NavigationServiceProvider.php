<?php

namespace App\Providers;
;
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
            return Menu::new()
                ->addClass('space-y-2')
                ->url('advertising', 'Advertising')
                ->route('links.index', 'Links')
                ->setActiveFromRequest();
        });
    }
}
