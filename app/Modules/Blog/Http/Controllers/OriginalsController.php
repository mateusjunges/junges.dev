<?php

namespace App\Modules\Blog\Http\Controllers;

use App\Modules\Blog\Models\Post;
use Illuminate\Contracts\View\View;
use function view;

final class OriginalsController
{
    public function __invoke(): View
    {
        $posts = Post::query()
            ->published()
            ->originalContent()
            ->simplePaginate(20);

        return view('front.originals.index', ['posts' => $posts]);
    }
}
