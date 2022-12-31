<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\HorizonApplicationServiceProvider;

final class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    protected function gate()
    {
        Gate::define('viewHorizon', function ($user): bool {
            return $user->email == 'mateus@junges.dev';
        });
    }
}
