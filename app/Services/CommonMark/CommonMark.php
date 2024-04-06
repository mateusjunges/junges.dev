<?php

namespace App\Services\CommonMark;

use App\Services\CommonMark\Extensions\CodeRendererExtension;
use Spatie\LaravelMarkdown\MarkdownRenderer;

final class CommonMark
{
    public static function convertToHtml(string $markdown, bool $highlightCode = false): string
    {
        $renderer = app(MarkdownRenderer::class);

        if (! $highlightCode) {
            $renderer->disableHighlighting();
        }

        $renderer->addExtension(new CodeRendererExtension());

        return $renderer->toHtml($markdown);
    }
}
