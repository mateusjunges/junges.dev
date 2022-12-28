<?php

namespace App\Modules\Blog\Actions;

use App\Models\Link;
use App\Modules\Blog\Models\Post;

class CreatePostFromLinkAction
{
    public function execute(Link $link): void
    {
        Post::query()->create([
            'submitted_by_user_id' => $link->user_id,
            'title' => $link->title,
            'text' => $link->text,
            'external_url' => $link->url,
            'published' => false,
        ]);
    }
}
