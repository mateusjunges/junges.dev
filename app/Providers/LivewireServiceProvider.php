<?php

namespace App\Providers;

use App\Http\Livewire\Repositories;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function register()
    {
        Livewire::component('repositories', Repositories::class);
    }
}
