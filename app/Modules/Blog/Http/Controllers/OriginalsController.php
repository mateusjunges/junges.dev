<?php

namespace App\Modules\Blog\Http\Controllers;

use App\Modules\Blog\Models\Post;

final class OriginalsController
{
    public function __invoke()
    {
        $posts = Post::query()
            ->original()
            ->published()
            ->simplePaginate();

        return view('modules.blog.posts.index', [
            'posts' => $posts
        ]);
    }
}
