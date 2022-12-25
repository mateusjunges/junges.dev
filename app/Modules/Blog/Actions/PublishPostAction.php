<?php

namespace App\Modules\Blog\Actions;

use App\Jobs\CreateOgImageJob;
use App\Jobs\TweetPostJob;
use App\Modules\Posts\Models\Post;
use Illuminate\Support\Facades\Bus;

final class PublishPostAction
{
    public function execute(Post $post): void
    {
        $post->published = true;

        if (! $post->publish_date) {
            $post->publish_date = now();
        }

        $post->save();

        Bus::chain([
            new CreateOgImageJob($post),
            new TweetPostJob($post),
        ])->dispatch();
    }
}
