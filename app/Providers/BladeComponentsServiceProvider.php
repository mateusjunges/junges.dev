<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

final class BladeComponentsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Blade::component('layouts.main', 'page');

        Blade::component('layouts.app', 'app');

        Blade::component('layouts.partials.sponsors', 'sponsors');

        Blade::component('modules.blog.components.post-header', 'post-header');

        Blade::component('modules.ads.components.ad', 'ad');
    }
}
