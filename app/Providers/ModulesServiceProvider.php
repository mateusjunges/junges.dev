<?php declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

final class ModulesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(
            provider: \App\Modules\Docs\Providers\DocsServiceProvider::class
        );
    }
}
