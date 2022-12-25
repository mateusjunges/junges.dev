<?php

namespace App\Modules\Blog\View\Components;

use App\Modules\Posts\Models\Post;
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
        return view('components.series-toc-component', [
            'currentPost' => $this->post,
            'allPostsInSeries' => $this->post->getAllPostsInSeries()
        ]);
    }
}
