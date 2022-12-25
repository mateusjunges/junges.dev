<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

final class BladeComponentsServiceProvider extends ServiceProvider
{
    public function register()
    {
        Blade::component('layouts.main', 'page');

        Blade::component('components.post-header', 'post-header');
    }
}
