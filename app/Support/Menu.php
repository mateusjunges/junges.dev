<?php declare(strict_types=1);

namespace App\Support;

use App\Modules\Auth\Http\Controllers\LoginController;
use App\Modules\Auth\Models\User;
use App\Modules\Home\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Spatie\Menu\Laravel\Menu as SpatieMenu;

final class Menu
{
    public static function primary(): SpatieMenu
    {
        return SpatieMenu::new()
            ->route('docs.index', 'Docs')
            ->action(HomeController::class, 'Home')
            ->route('links.index', 'Links')
            ->route('about', 'About')
            ->route('uses', 'Uses')
            ->setActiveFromRequest();
    }

    public static function secondary(bool $withSpaceClass = true): SpatieMenu
    {
        $menu = SpatieMenu::new()
            ->url('advertising', 'Advertising')
            ->setActiveFromRequest();

        if ($withSpaceClass) {
            $menu->addClass('space-y-2');
        }

        $user = Auth::user();

        if ($user instanceof User) {
            if ($user->admin) {
                $menu->url('/admin', 'Admin Panel');
            }

            $menu->action([LoginController::class, 'logout'], 'Logout');

            return $menu;

        }

        $menu->action([LoginController::class, 'showLoginForm'], 'Login');

        return $menu;
    }
}