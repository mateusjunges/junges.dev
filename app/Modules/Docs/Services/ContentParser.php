<?php declare(strict_types=1);

namespace App\Modules\Docs\Services;

use Illuminate\Support\HtmlString;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Extension\CommonMark\Renderer\Inline\ImageRenderer;
use League\CommonMark\Extension\CommonMark\Renderer\Inline\LinkRenderer;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\Table\TableExtension;
use Spatie\LaravelMarkdown\MarkdownRenderer;
use Spatie\Sheets\ContentParser as ContentParserContract;
use Spatie\YamlFrontMatter\YamlFrontMatter;

final class ContentParser implements ContentParserContract
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
                    'html_class' => 'anchor-link doc-anchor-link',
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
