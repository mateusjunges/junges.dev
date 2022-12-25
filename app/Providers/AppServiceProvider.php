<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Illuminate\Foundation\Vite;

final class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        try {
            Filament::registerTheme(
                app(Vite::class)('resources/css/filament.css'),
            );
        } catch (\Exception) {
        }
    }
}
