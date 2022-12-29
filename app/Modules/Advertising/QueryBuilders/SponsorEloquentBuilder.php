<?php declare(strict_types=1);

namespace App\Modules\Advertising\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

/**
 * @template TModelClass of \App\Modules\Advertising\Models\Sponsor
 * @extends \Illuminate\Database\Eloquent\Builder<TModelClass>
 */
final class SponsorEloquentBuilder extends Builder
{
    public function currentSponsoring(): self
    {
        return $this->whereNull('stop_sponsoring_at')
            ->orWhere('stop_sponsoring_at', '>=', now());
    }
}
