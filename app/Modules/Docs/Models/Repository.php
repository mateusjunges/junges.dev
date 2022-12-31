<?php

namespace App\Modules\Docs\Models;

use App\Modules\Docs\QueryBuilders\RepositoryEloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Tests\Factories\RepositoryFactory;

/**
 * @property int $id The identifier of the repository.
 * @property int $stars The number of stars this repository has on GitHub.
 * @property string $name The name of the repository
 * @property string $description The description of the repository.
 * @property array $topics The topics of the repository.
 * @property bool $highlighted Whether the repository should be highlighted.
 * @property string $type The type of this repository
 * @property int $downloads The number of downloads this repository has on Packagist.
 * @property int $forks The number of forks this repository has on GitHub.
 * @property string $language Tha language used in this package.
 * @property \Illuminate\Support\Carbon $created_at The date and time this repository was created.
 * @property \Illuminate\Support\Carbon $updated_at The date and time this repository was last updated.
 *
 */
final class Repository extends Model
{
    use HasFactory;

    /** @var string $table */
    protected $table = 'docs__repositories';

    protected $guarded = ['id'];

    protected $casts = [
        'topics' => 'array'
    ];

    /**
     * @inheritDoc
     * @param \Illuminate\Database\Query\Builder $query
     * @return RepositoryEloquentBuilder<self>
     */
    public static function query(): RepositoryEloquentBuilder
    {
        $query = parent::query();
        assert($query instanceof RepositoryEloquentBuilder);

        return $query;
    }

    /**
     * @inheritDoc
     * @param \Illuminate\Database\Query\Builder $query
     * @return RepositoryEloquentBuilder<self>
     */
    public function newEloquentBuilder($query): RepositoryEloquentBuilder
    {
        return new RepositoryEloquentBuilder($query);
    }

    public function getSlug(): string
    {
        return Str::slug($this->name);
    }

    public function getUrlAttribute(): string
    {
        return "https://github.com/mateusjunges/{$this->name}";
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

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): RepositoryFactory
    {
        return new RepositoryFactory();
    }
}
