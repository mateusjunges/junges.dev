<?php

declare(strict_types=1);

namespace App\Modules\Blog\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

/**
 * @template TModelClass of \App\Modules\Blog\Models\Post
 *
 * @extends \Illuminate\Database\Eloquent\Builder<TModelClass>
 */
final class PostEloquentBuilder extends Builder
{
    public function published(): self
    {
        return $this
            ->where('published', true)
            ->orderBy('publish_date', 'desc')
            ->orderBy('id', 'desc');
    }

    public function originalContent(): self
    {
        return $this->where('original_content', true);
    }

    public function scheduled(): self
    {
        return $this->where('published', false)
            ->whereNotNull('publish_date');
    }
}
