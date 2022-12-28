<?php declare(strict_types=1);

namespace App\Modules\Blog\Actions;

use App\Modules\Blog\Jobs\CreateOgImageJob;
use App\Modules\Blog\Jobs\TweetPostJob;
use App\Modules\Blog\Models\Post;
use Spatie\ResponseCache\Facades\ResponseCache;

final class PublishPostAction
{
    public function execute(Post $post):void
    {
        $post->published = true;

        if (! $post->publish_date) {
            $post->publish_date = now();
        }

        $post->save();

        ResponseCache::clear();

        dispatch(new CreateOgImageJob($post));
        dispatch(new TweetPostJob($post))->delay(now()->addSeconds(20));
    }
}
