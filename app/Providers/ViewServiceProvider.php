<?php

namespace App\Providers;

use App\Http\ViewComposers\LazyViewComposer;
use App\Modules\Advertising\View\Composers\SponsorsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

final class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        View::composer('front.components.lazy', LazyViewComposer::class);
        View::composer('front.layouts.partials.sponsors', SponsorsComposer::class);
    }
}
