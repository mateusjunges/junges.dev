<?php

namespace App\Modules\Blog\Http\Controllers;

use App\Modules\Advertising\Models\Ad;
use App\Modules\Blog\Models\Post;
use Illuminate\Contracts\View\View;

final class ShowPostController
{
    public function __invoke(Post $post): View
    {
        $ad = Ad::getForCurrentPage();

        if (! $post->exists) {
            abort(404);
        }

        return view('front.posts.show', ['post' => $post, 'ad' => $ad]);
    }
}
