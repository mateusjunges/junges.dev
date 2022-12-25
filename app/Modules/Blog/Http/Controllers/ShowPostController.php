<?php

namespace App\Modules\Posts\Http\Controllers;

use App\Modules\Posts\Models\Post;

class ShowPostController
{
    public function __invoke(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }
}
