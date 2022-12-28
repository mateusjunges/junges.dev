<?php

namespace App\Modules\Home\Http\Controllers;

use App\Modules\Blog\Models\Post;

final class HomeController
{
    public function __invoke()
    {
        $posts = Post::query()
            ->published()
            ->simplePaginate(20);

        return view('front.home.index', compact('posts'));
    }
}
