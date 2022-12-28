<?php declare(strict_types=1);

namespace App\Modules\Advertising\Models;

use App\Modules\Advertising\QueryBuilders\AdEloquentBuilder;
use App\Services\CommonMark\CommonMark;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Tests\Factories\AdFactory;

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
        static::saved(function (Ad $ad) {
            static::withoutEvents(function () use ($ad) {
                $ad->update(['html' => CommonMark::convertToHtml($ad->text, false)]);
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
        return static::getPageSpecificAd($url) ?? static::getSiteWideAd();
    }

    public static function getPageSpecificAd(string $url): ?self
    {
        return static::query()->current()
            ->where('display_on_url', $url)
            ->first();
    }

    public static function getSiteWideAd(): ?self
    {
        return static::current()
            ->where(function (Builder $query) {
                $query
                    ->where('display_on_url', '')
                    ->orWhereNull('display_on_url');
            })
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
