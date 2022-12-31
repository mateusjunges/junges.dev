<?php

namespace App\Providers;

use App\Modules\Advertising\Http\Components\AdComponent;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

final class BladeComponentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::component('ad', AdComponent::class);

        Blade::component('front.components.inputField', 'input-field');
        Blade::component('front.components.submitButton', 'submit-button');
        Blade::component('front.components.textarea', 'textarea');
        Blade::component('front.components.textarea', 'textarea');
        Blade::component('front.components.shareButton', 'share-button');
        Blade::component('front.components.lazy', 'lazy');
        Blade::component('front.components.postHeader', 'post-header');

        Blade::component('front.layouts.app', 'app-layout');
        Blade::component('front.layouts.app-docs', 'app-docs-layout');
        Blade::component('front.layouts.error', 'error-layout');
    }
}
