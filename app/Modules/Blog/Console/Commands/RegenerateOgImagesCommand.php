<?php

namespace App\Modules\Blog\Console\Commands;

use App\Modules\Blog\Jobs\CreateOgImageJob;
use App\Modules\Blog\Models\Post;
use Illuminate\Console\Command;

final class RegenerateOgImagesCommand extends Command
{
    protected $signature = 'regenerate-og-images';

    public function handle(): void
    {
        Post::query()->latest()->limit(200)->each(function (Post $post) {
            dispatch(new CreateOgImageJob($post));
        });

        $this->info('All done!');
    }
}
