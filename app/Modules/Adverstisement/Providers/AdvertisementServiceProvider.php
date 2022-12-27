<?php declare(strict_types=1);

namespace App\Modules\Adverstisement\Providers;

use App\Modules\Adverstisement\View\Composers\SponsorsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

final class AdvertisementServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('layouts.partials.sponsors', SponsorsComposer::class);
    }
}
