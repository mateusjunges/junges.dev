<?php

declare(strict_types=1);

namespace App\Modules\Advertising\Models;

use App\Modules\Advertising\QueryBuilders\AdEloquentBuilder;
use App\Services\CommonMark\CommonMark;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Tests\Factories\AdFactory;

/**
 * @property int $id The ID of the ad.
 * @property \Illuminate\Support\Carbon $starts_at The date the ad starts showing.
 * @property \Illuminate\Support\Carbon $ends_at The date the ad stops showing.
 * @property string|null $display_on_url The URL the ad should be displayed on.
 * @property string $text The content of the ad.
 * @property string $html The HTML content of the ad.
 * @property \Illuminate\Support\Carbon $created_at The date the ad was created.
 * @property \Illuminate\Support\Carbon $updated_at The date the ad was last updated.
 */
final class Ad extends Model
{
    use HasFactory;

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    protected $table = 'advertising__ads';

    public static function booted()
    {
        self::saved(function (Ad $ad) {
            self::withoutEvents(function () use ($ad) {
                $ad->update(['html' => CommonMark::convertToHtml($ad->text)]);
            });
        });
    }

    public static function query()
    {
        $builder = parent::query();
        assert($builder instanceof AdEloquentBuilder);

        return $builder;
    }

    public function newEloquentBuilder($query): AdEloquentBuilder
    {
        return new AdEloquentBuilder($query);
    }

    public static function getForCurrentPage(): ?self
    {
        return Ad::getForPage(request()->path());
    }

    public static function getForPage(string $url = ''): ?self
    {
        return self::getPageSpecificAd($url) ?? self::getSiteWideAd();
    }

    public static function getPageSpecificAd(string $url): ?self
    {
        return self::query()->current()
            ->where('display_on_url', $url)
            ->first();
    }

    public static function getSiteWideAd(): ?self
    {
        return self::query()->current()
            ->siteWide()
            ->first();
    }

    public function formattedText(): Attribute
    {
        return new Attribute(
            get: fn () => CommonMark::convertToHtml($this->text),
        );
    }

    public function excerpt(): Attribute
    {
        return new Attribute(
            get: fn () => Str::limit($this->text),
        );
    }

    public static function newFactory(): AdFactory
    {
        return new AdFactory();
    }
}
