<?php

namespace App\Modules\Blog\Console\Commands;

use App\Models\Video;
use App\Modules\Advertising\Models\Ad;
use App\Modules\Blog\Actions\ConvertPostTextToHtmlAction;
use App\Modules\Blog\Models\Post;
use Illuminate\Console\Command;

final class PerformHtmlConversionCommand extends Command
{
    protected $signature = 'blog:perform-html-conversion';

    protected $description = 'Command description';

    public function handle(): void
    {
        $this->info('Performing HTML conversions...');

        Video::each(function (Video $video) {
            $video->touch();

            $this->comment("Conversion done for video `{$video->id}`");
        });

        Ad::each(function (Ad $ad) {
            $ad->touch();

            $this->comment("Conversion done for ad `{$ad->id}`");
        });

        Post::all()->reverse()->each(function (Post $post) {
            (new ConvertPostTextToHtmlAction())->execute($post);

            $this->comment("Conversion done for post `{$post->id}`");
        });

        $this->info('All done!');
    }
}
