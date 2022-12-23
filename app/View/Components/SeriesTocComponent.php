<?php

namespace App\View\Components;

use App\Modules\Posts\Models\Post;
use Illuminate\View\Component;

class SeriesTocComponent extends Component
{
    public function __construct(
        public Post $post
    ){
    }

    public function render()
    {
        return view('components.series-toc-component', [
            'currentPost' => $this->post,
            'allPostsInSeries' => $this->post->getAllPostsInSeries()
        ]);
    }
}
