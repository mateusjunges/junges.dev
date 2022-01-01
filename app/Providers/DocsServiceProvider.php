<?php

namespace App\Providers;

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
                'sheet_class' => \App\Docs\DocumentationPage::class,
                'path_parser' => \App\Docs\DocumentationPathParser::class,
                'content_parser' => \App\Docs\DocumentationContentParser::class,
            ]);
        }
    }
}
