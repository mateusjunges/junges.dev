<?php

declare(strict_types=1);

namespace App\Modules\Advertising\Models;

use App\Modules\Advertising\QueryBuilders\SponsorEloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id The sponsor identifier.
 * @property string $name The sponsor name.
 * @property string $alt_text The sponsor alt text used for logos.
 * @property string $website The sponsor website.
 * @property string $github_username The sponsor's GitHub username.
 * @property string $github_avatar_url The sponsor's GitHub avatar URL.
 * @property string $monthly_price_in_dollars The sponsor's monthly price in dollars.
 * @property \Illuminate\Support\Carbon $started_sponsoring_at The date and time the sponsor started sponsoring.
 */
final class Sponsor extends Model
{
    protected $table = 'advertising__sponsors';

    /** @var list<string> */
    protected $fillable = [
        'name',
        'website',
        'alt_text',
        'logo_url',
        'sponsor_tier',
        'started_sponsoring_at',
        'stop_sponsoring_at',
        'github_username',
        'github_avatar_url',
    ];

    /** {@inheritDoc} */
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'started_sponsoring_at' => 'datetime',
        ];
    }

    public static function query(): SponsorEloquentBuilder
    {
        $builder = parent::query();
        assert($builder instanceof SponsorEloquentBuilder);

        return $builder;
    }

    /** {@inheritDoc} */
    public function newEloquentBuilder($query): SponsorEloquentBuilder
    {
        return new SponsorEloquentBuilder($query);
    }

    public function getLogoAbsoluteUrl(): string
    {
        return Storage::disk('sponsors')->url($this->attributes['logo_url']);
    }

    public function getLogoUrlForHtml(): string
    {
        return $this->getLogoAbsoluteUrl() ?? $this->github_avatar_url;
    }
}
