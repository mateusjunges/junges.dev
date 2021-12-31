<?php

namespace App\Docs;

use Illuminate\Support\HtmlString;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Inline\Element\Image;
use League\CommonMark\Inline\Element\Link;
use League\CommonMark\Inline\Renderer\ImageRenderer;
use League\CommonMark\Inline\Renderer\LinkRenderer;
use Spatie\LaravelMarkdown\MarkdownRenderer;
use Spatie\Sheets\ContentParser;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class DocumentationContentParser implements ContentParser
{
    protected MarkdownRenderer $markdownRenderer;

    public function __construct()
    {
        $this->markdownRenderer = app(MarkdownRenderer::class)
            ->addExtension(new TableExtension())
            ->addExtension(new HeadingPermalinkExtension())
            ->addInlineRenderer(Image::class, new ImageRenderer())
            ->addInlineRenderer(Link::class, new LinkRenderer())
            ->commonmarkOptions([
                'heading_permalink' => [
                    'html_class' => 'anchor-link',
                    'symbol' => '#',
                ]
            ]);
    }

    public function parse(string $contents): array
    {
        $document = YamlFrontMatter::parse($contents);

        $htmlContents = $this->markdownRenderer->toHtml($document->body());

        return array_merge(
            $document->matter(),
            ['contents' => new HtmlString($htmlContents)]
        );
    }
}
