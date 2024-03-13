<?php

declare(strict_types=1);

namespace App\Modules\Blog\QueryBuilders;

use App\Modules\Blog\Models\Link;
use Illuminate\Database\Eloquent\Builder;

/**
 * @template TModelClass of \App\Modules\Blog\Models\Link
 *
 * @extends \Illuminate\Database\Eloquent\Builder<TModelClass>
 */
final class LinkEloquentBuilder extends Builder
{
    public function approved(): self
    {
        return $this->where('status', Link::STATUS_APPROVED);
    }
}
