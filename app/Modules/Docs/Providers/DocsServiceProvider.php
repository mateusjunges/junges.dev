<?php declare(strict_types=1);

namespace App\Modules\Docs\Providers;

use Illuminate\Support\ServiceProvider;

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
    }
}
