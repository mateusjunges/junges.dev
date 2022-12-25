<?php declare(strict_types=1);

namespace App\Providers;

use App\Modules\Documentation\Providers\DocsServiceProvider;
use App\Modules\Home\Providers\HomeServiceProvider;
use Illuminate\Support\ServiceProvider;

final class ModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(
            provider: DocsServiceProvider::class
        );

        $this->app->register(
            provider: HomeServiceProvider::class
        );
    }
}
