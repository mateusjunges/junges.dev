<?php

namespace App\Modules\Blog\Http\Controllers;

use App\Modules\Blog\Models\Post;
use Illuminate\Contracts\View\View;

final class OgImageController
{
    public function __invoke(Post $post): View
    {
        return view('front.posts.ogImage', compact('post'));
    }
}
