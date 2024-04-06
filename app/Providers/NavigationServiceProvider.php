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
}
