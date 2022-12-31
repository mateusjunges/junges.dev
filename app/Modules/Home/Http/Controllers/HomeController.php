<?php

namespace App\Modules\Home\Http\Controllers;

use App\Modules\Blog\Models\Post;
use Illuminate\Contracts\View\View;

final class HomeController
{
    public function __invoke(): View
    {
        $posts = Post::query()
            ->published()
            ->simplePaginate(20);

        return view('front.home.index', ['posts' => $posts]);
    }
}
