<?php

namespace App\Modules\Blog\Console\Commands;

use App\Modules\Blog\Actions\PublishPostAction;
use App\Modules\Blog\Models\Post;
use Illuminate\Console\Command;

final class PublishScheduledPostsCommand extends Command
{
    protected $signature = 'blog:publish-scheduled-posts';

    protected $description = 'Publish scheduled posts';

    public function handle(PublishPostAction $publishPostAction)
    {
        Post::scheduled()->get()
            ->reject(fn (Post $post) => $post->publish_date->isFuture())
            ->each(fn (Post $post) => $publishPostAction->execute($post));
    }
}
