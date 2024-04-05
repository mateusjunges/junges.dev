<?php

namespace App\Http\Controllers;

use App\Modules\Blog\Models\Post;
use Illuminate\Http\Request;

final class UsesController
{
    public function __invoke()
    {
        $post = Post::query()->find(3);
        assert($post instanceof Post);

        return view('front.posts.show', [
            'post' => $post
        ]);
    }
}
