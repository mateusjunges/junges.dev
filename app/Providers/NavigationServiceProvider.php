<?php

namespace App\Providers;

use App\Modules\Auth\Http\Controllers\LoginController;
use App\Modules\Auth\Models\User;
use App\Modules\Home\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Spatie\Menu\Laravel\Menu;

final class NavigationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Menu::macro('primary', function () {
            return Menu::new()
                ->route('docs.index', 'Docs')
                ->action(HomeController::class, 'Home')
                ->route('links.index', 'Links')
                ->route('about', 'About')
                ->setActiveFromRequest();
        });

        Menu::macro('secondary', function (bool $withSpaceClass = true) {
            $menu = Menu::new()
                ->url('advertising', 'Advertising')
                ->setActiveFromRequest();

            if ($withSpaceClass) {
                $menu->addClass('space-y-2');
            }

            $user = Auth::user();
            if ($user !== null) {
                assert($user instanceof User);

                if ($user->admin) {
                    $menu->url('/admin', 'Admin Panel');
                }

                $menu->action([LoginController::class, 'logout'], 'Logout');

            } else {
                $menu->action([LoginController::class, 'showLoginForm'], 'Login');
            }

            return $menu;
        });
    }
}
