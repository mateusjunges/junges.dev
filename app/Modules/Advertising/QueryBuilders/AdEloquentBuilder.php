<?php declare(strict_types=1);

namespace App\Modules\Advertising\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

/**
 * @template TModelClass of \App\Modules\Advertising\Models\Ad
 * @extends \Illuminate\Database\Eloquent\Builder<TModelClass>
 */
final class AdEloquentBuilder extends Builder
{
    public function current(): self
    {
        $now = now()->format('Y-m-d');

        return $this
            ->whereDate('starts_at', '<=', $now)
            ->whereDate('ends_at', '>=', $now);
    }
}