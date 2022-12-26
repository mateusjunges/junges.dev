<?php

namespace App\Modules\Blog\Http\Controllers;

use App\Modules\Blog\Models\Post;

final class ShowPostController
{
    public function __invoke(Post $post)
    {
        return view('modules.blog.posts.show', [
            'post' => $post,
        ]);
    }
}
