<?php declare(strict_types=1);

namespace App\Modules\Adverstisement\Models;

use App\Modules\Adverstisement\QueryBuilders\AdEloquentBuilder;
use App\Services\CommonMark\CommonMark;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

final class Ad extends Model
{
    /** @var string $table */
    protected $table = 'advertisement__ads';

    /** @var array<string, string> $casts */
    protected $casts = [
        'start_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    /**
     * @inheritDoc
     * @return AdEloquentBuilder<self>
     */
    public static function query(): AdEloquentBuilder
    {
        $builder = parent::query();
        assert($builder instanceof AdEloquentBuilder);

        return $builder;
    }

    /**
     * @inheritDoc
     * @param \Illuminate\Database\Query\Builder $query
     * @return AdEloquentBuilder<self>
     */
    public function newEloquentBuilder($query): AdEloquentBuilder
    {
        return new AdEloquentBuilder($query);
    }

    public static function booted()
    {
        Ad::saved(function (Ad $ad) {
            Ad::withoutEvents(function () use ($ad) {
                $ad->update(['html' => CommonMark::convertToHtml($ad->text, false)]);
            });
        });
    }

    public static function getForPage(string $url = ''): ?self
    {
        return self::getPageSpecificAd($url) ?? self::getSiteWideAd();
    }

    public static function getPageSpecificAd(string $url): ?self
    {
        $ad = self::query()->current()
            ->where('display_on_url', $url)
            ->first();

        if ($ad === null) {
            return null;
        }

        assert($ad instanceof Ad);

        return $ad;
    }

    public static function getSiteWideAd(): ?self
    {
        return self::current()
            ->where(function (Builder $query) {
                $query
                    ->where('display_on_url', '')
                    ->orWhereNull('display_on_url');
            })
            ->first();
    }

    public function getFormattedTextAttribute(): string
    {
        return CommonMark::convertToHtml($this->text);
    }

    public function getExcerptAttribute(): string
    {
        return Str::limit($this->text);
    }
}
