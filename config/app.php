<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    'log' => env('APP_LOG', 'single'),

    'log_level' => env('APP_LOG_LEVEL', 'debug'),

    'providers' => ServiceProvider::defaultProviders()->merge([
        \App\Providers\FlashServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\HorizonServiceProvider::class,
        \App\Providers\RouteServiceProvider::class,
        App\Providers\TelescopeServiceProvider::class,
        \App\Providers\TwitterServiceProvider::class,
        \App\Providers\ViewServiceProvider::class,
        \App\Providers\BladeComponentServiceProvider::class,
        \App\Providers\HealthServiceProvider::class,

        /**
         * Modules providers
         */
        \App\Providers\ModulesServiceProvider::class,

        \App\Providers\NavigationServiceProvider::class,
    ])->toArray(),

];
