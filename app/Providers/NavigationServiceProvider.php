<?php declare(strict_types=1);

namespace App\Providers;

use App\Modules\Blog\Http\Controllers\OriginalsController;
use App\Modules\Documentation\Http\Controllers\DocsController;
use App\Modules\Home\Http\Controllers\HomeController;
use Illuminate\Support\ServiceProvider;
use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Link;

final class NavigationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Menu::macro('primary', function () {
            return Menu::new()
                ->action(HomeController::class, 'Home')
                ->action(OriginalsController::class, 'Originals')
                ->action([DocsController::class, 'index'], 'Docs    ')
//                ->action(IndexController::class, 'Community')
//                ->add(Link::to(action(NewsletterController::class), 'Newsletter')->addParentClass('mt-4'))
//                ->add(Link::to(action(SpeakingController::class), 'Speaking')->addParentClass('mt-4'))
//                ->action(MusicController::class, 'Music')
                ->url('uses', 'Uses')
                ->url('about', 'About')
                ->setActiveFromRequest();
        });

        Menu::macro('secondary', function () {
            return Menu::new()
                ->addClass('space-y-2')
                ->url('search', 'Search')
                ->url('advertising', 'Advertising')

                ->setActiveFromRequest();
        });
    }
}
