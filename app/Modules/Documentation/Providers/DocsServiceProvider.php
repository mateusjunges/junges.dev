<?php

namespace App\Modules\Documentation\Providers;

use Illuminate\Support\ServiceProvider;

class DocsServiceProvider extends ServiceProvider
{
    public function register()
    {
        foreach (config('docs.repositories') as $docsRepository) {
            config()->set("filesystems.disks.{$docsRepository['name']}", [
                'driver' => 'local',
                'root' => storage_path("docs/{$docsRepository['name']}"),
            ]);

            config()->set("sheets.collections.{$docsRepository['name']}", [
                'disk' => $docsRepository['name'],
                'sheet_class' => \App\Modules\Documentation\Sheets\DocumentationPage::class,
                'path_parser' => \App\Modules\Documentation\Services\DocumentationPathParser::class,
                'content_parser' => \App\Modules\Documentation\Services\DocumentationContentParser::class,
            ]);
        }
    }
}
