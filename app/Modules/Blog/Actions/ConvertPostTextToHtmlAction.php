<?php

namespace App\Modules\Blog\Actions;

use App\Modules\Blog\Models\Post;
use App\Services\CommonMark\CommonMark;
use App\View\Components\SeriesNextPostComponent;
use App\View\Components\SeriesTocComponent;

final class ConvertPostTextToHtmlAction
{
    public function execute(Post $post): void
    {
        $text = $post->text;

        if ($post->isPartOfSeries()) {
            $text = str_replace(
                '[series-toc]',
                (new SeriesTocComponent($post))->render().PHP_EOL,
                $text
            );

            $text = str_replace(
                '[series-next-post]',
                (new SeriesNextPostComponent($post))->render(),
                $text
            );
        }

        $html = CommonMark::convertToHtml($text, highlightCode: true);

        $post->update(['html' => $html]);
    }
}
