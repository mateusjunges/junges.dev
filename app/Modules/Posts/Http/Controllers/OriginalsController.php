<?php

namespace App\Modules\Posts\Http\Controllers;

use App\Modules\Posts\Models\Post;

class OriginalsController
{
    public function __invoke()
    {
        $posts = Post::query()
            ->original()
            ->published()
            ->simplePaginate();

        return view('posts.index', [
            'posts' => $posts
        ]);
    }
}
