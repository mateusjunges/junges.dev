<?php declare(strict_types=1);

namespace App\Modules\Advertising\Models;

use App\Modules\Advertising\QueryBuilders\SponsorEloquentBuilder;
use Illuminate\Database\Eloquent\Model;

final class Sponsor extends Model
{
    protected $table= 'advertising__sponsors';

    /** @var array<string, string> $casts */
    protected $casts = [
        'started_sponsoring_at' => 'datetime'
    ];

    /** @inheritDoc */
    public static function query(): SponsorEloquentBuilder
    {
        $builder = parent::query();
        assert($builder instanceof SponsorEloquentBuilder);

        return $builder;
    }

    /** @inheritDoc */
    public function newEloquentBuilder($query): SponsorEloquentBuilder
    {
        return new SponsorEloquentBuilder($query);
    }
}
