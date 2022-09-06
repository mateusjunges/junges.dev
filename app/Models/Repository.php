<?php

namespace App\Models;

use App\Models\Enums\RepositoryType;
use BadMethodCallException;
use Database\Factories\RepositoryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * @property int stars
 * @method static \Illuminate\Database\Eloquent\Builder visible();
 * @method static \Illuminate\Database\Eloquent\Builder whereName(string $name);
 */
class Repository extends Model
{
    use HasFactory;

    const TYPE_PACKAGE = 'package';
    const TYPE_PROJECT = 'project';

    protected $guarded = ['id'];

    protected $casts = [
        'topics' => 'array'
    ];

    public function getSlug(): string
    {
        return Str::slug($this->name);
    }

    public function getUrlAttribute(): string
    {
        return "https://github.com/mateusjunges/{$this->name}";
    }

    public function getFullNameAttribute(): string
    {
        return "mateusjunges/{$this->name}";
    }

    public function getLanguageColorAttribute(): string
    {
        $colors = [
            'PHP' => 'blue',
            'JavaScript' => 'orange',
        ];

        return $colors[$this->language] ?? 'gray';
    }

    public static function getTotalDownloads(): int
    {
        return static::sum('downloads');
    }

    public function setTopics(Collection $topics): self
    {
        $this->topics = $topics->toArray();

        $this->save();

        return $this;
    }

    public function scopeVisible(Builder $builder): void
    {
        $builder->where('visible', true);
    }

    public function scopeWhereName(Builder $builder, string $name): void
    {
        $builder->where('name', $name);
    }

    public function scopePackages(Builder $builder): void
    {
        $builder->where('type', RepositoryType::PACKAGE);
    }

    public function scopeProjects(Builder $builder): void
    {
        $builder->where('type', RepositoryType::PROJECT);
    }

    public function scopeHighlighted(Builder $builder): void
    {
        $builder->where('highlighted', true);
    }

    public function scopeSearch(Builder $builder, string $search): void
    {
        if (! $search) {
            return;
        }

        $builder->where('name', 'LIKE', "%{$search}%");
    }

    public function scopeApplySort(Builder $builder, string $sort): void
    {
        if (! $sort) {
            return;
        }

        collect(['name', 'stars', 'repository_created_at', 'downloads'])->first(function (string $validSort) use ($sort) {
            return ltrim($sort, '-') === $validSort;
        }, function () use ($sort) {
            throw new BadMethodCallException('Not allowed to sort by `' . $sort . '`');
        });

        $builder->orderBy(
            ltrim($sort, '-'),
            Str::startsWith($sort, '-') ? 'desc' : 'asc'
        );
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Database\Factories\RepositoryFactory
     */
    protected static function newFactory(): RepositoryFactory
    {
        return new RepositoryFactory();
    }
}
