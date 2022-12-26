<?php

namespace App\Modules\Blog\View\Components;

use App\Modules\Blog\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class SeriesTocComponent extends Component
{
    public function __construct(
        public Post $post
    ){
    }

    public function render(): View
    {
        return view('modules.blog.components.series-toc-component', [
            'currentPost' => $this->post,
            'allPostsInSeries' => $this->post->getAllPostsInSeries()
        ]);
    }
}
