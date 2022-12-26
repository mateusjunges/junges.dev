<?php

namespace App\Modules\Blog\View\Components;

use App\Modules\Blog\Models\Post;
use Illuminate\View\Component;
use Illuminate\View\View;

final class SeriesNextPostComponent extends Component
{
    public function __construct(
        public Post $post
    ){
    }

    public function render(): View
    {
        $nextPost = Post::query()
            ->where('series_slug', $this->post->series_slug)
            ->where('id', '>', $this->post->id)
            ->orderBy('id')
            ->first();

        return view('modules.blog.components.series-next-post-component', compact('nextPost'));
    }
}
