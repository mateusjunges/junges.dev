<?php

namespace App\Modules\Blog\Http\Controllers;

use App\Modules\Posts\Models\Post;

final class ShowPostController
{
    public function __invoke(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }
}
