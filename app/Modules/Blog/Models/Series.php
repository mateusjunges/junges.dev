<?php

namespace App\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
final class Series extends Model
{
    use HasFactory;

    protected $table = 'blog__series';

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'series_id');
    }
}
