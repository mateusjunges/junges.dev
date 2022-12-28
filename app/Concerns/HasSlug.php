<?php

namespace App\Concerns;

use App\Contracts\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property string $slug
 * @property int $id
 * @mixin Model
 */
trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::saving(function (Sluggable $model) {
            $model->slug = Str::slug($model->getSluggableValue());
        });
    }

    public function idSlug(): string
    {
        return "{$this->id}-{$this->slug}";
    }

    public static function findByIdSlug(string $idSlug): ?Model
    {
        [$id] = explode('-', $idSlug);

        return static::query()->find($id);
    }
}
