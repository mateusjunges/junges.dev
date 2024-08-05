<?php

declare(strict_types=1);

namespace App\Modules\Docs\Services;

use App\Modules\Docs\Http\Controllers\DocsController;
use Spatie\Sheets\ContentParsers\MarkdownWithFrontMatterParser;
use Spatie\YamlFrontMatter\YamlFrontMatter;

final class ContentParser extends MarkdownWithFrontMatterParser
{

    public function parse(string $contents): array
    {
        $document = YamlFrontMatter::parse($contents);

        return array_merge(
            $document->matter(),
            /**
             * Markdown parsing is done when rendering the page.
             * @see DocsController::show()
             */
            ['contents' => $document->body()]
        );
    }
}
