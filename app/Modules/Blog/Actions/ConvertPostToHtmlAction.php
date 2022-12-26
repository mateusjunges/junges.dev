<?php

namespace App\Modules\Blog\Actions;

use App\Modules\Blog\View\Components\SeriesNextPostComponent;
use App\Modules\Blog\View\Components\SeriesTocComponent;
use App\Modules\Blog\Models\Post;
use App\Services\CommonMark\CommonMark;

final class ConvertPostToHtmlAction
{
    public function execute(Post $post): void
    {

        $text = $post->text;

        if ($post->isPartOfSeries()) {

            $text = str_replace(
                '[series-toc]',
                (new SeriesTocComponent($post))->render() . PHP_EOL,
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
