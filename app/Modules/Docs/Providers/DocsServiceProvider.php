<?php declare(strict_types=1);

namespace App\Modules\Docs\Providers;

use App\Modules\Docs\Contracts\ValueStoreDriver;
use App\Modules\Docs\ValueStores\Drivers\FileValueStoreDriver;
use Illuminate\Support\ServiceProvider;
use Spatie\Valuestore\Valuestore;

final class DocsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        foreach (config('docs.repositories') as $docsRepository) {
            config()->set("filesystems.disks.{$docsRepository['name']}", [
                'driver' => 'local',
                'root' => storage_path("docs/{$docsRepository['name']}"),
            ]);

            config()->set("sheets.collections.{$docsRepository['name']}", [
                'disk' => $docsRepository['name'],
                'sheet_class' => \App\Modules\Docs\Sheets\DocumentationPage::class,
                'path_parser' => \App\Modules\Docs\Services\PathParser::class,
                'content_parser' => \App\Modules\Docs\Services\ContentParser::class,
            ]);
        }

        $this->app->bind(ValueStoreDriver::class, function () {
            $store = Valuestore::make(config('docs.valuestore.filename'));

            return new FileValueStoreDriver(
                store: $store,
            );
        });
    }
}
