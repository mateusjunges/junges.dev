<?php

namespace App\Modules\Blog\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

/**
 * @template TModelClass of \App\Modules\Posts\Models\Post
 * @extends \Illuminate\Database\Eloquent\Builder<TModelClass>
 */
final class PostsEloquentBuilder extends Builder
{
    public function published(): self
    {
        return $this->whereNotNull('publish_date');
    }

    public function original(): self
    {
        return $this->where('original_content', true);
    }
}
