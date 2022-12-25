<?php

namespace App\Services\CommonMark;

use Spatie\LaravelMarkdown\MarkdownRenderer;

final class CommonMark
{
    public static function convertToHtml(string $markdown, bool $highlightCode = false): string
    {
        $renderer = app(MarkdownRenderer::class);

        if (! $highlightCode) {
            $renderer->disableHighlighting();
        }

        return $renderer->toHtml($markdown);
    }
}
