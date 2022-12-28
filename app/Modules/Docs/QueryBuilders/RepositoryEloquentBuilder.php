<?php declare(strict_types=1);

namespace App\Modules\Docs\QueryBuilders;

use App\Modules\Docs\Enums\RepositoryType;
use Illuminate\Database\Eloquent\Builder;

/**
 * @template TModelClass of \App\Modules\Docs\Models\Repository
 * @extends \Illuminate\Database\Eloquent\Builder<TModelClass>
 */
final class RepositoryEloquentBuilder extends Builder
{
    public function visible(): self
    {
        return $this->where('visible', true);
    }

    public function whereName(string $name): self
    {
        return $this->where('name', $name);
    }

    public function project(): self
    {
        return $this->where('type', RepositoryType::PROJECT->value);
    }

    public function packages(): self
    {
        return $this->where('type', RepositoryType::PACKAGE->value);
    }

    public function highlighted(): self
    {
        return $this->where('highlighted', true);
    }
}
