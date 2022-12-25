<?php

namespace App\Modules\Documentation\ValueStores;

use Illuminate\Support\Arr;
use Spatie\Valuestore\Valuestore;

final class UpdatedRepositoriesValueStore extends Valuestore
{
    protected Valuestore $valueStore;

    protected string $fileName = 'updatesRepositories.json';

    public static function make(string $fileName = 'updatesRepositories', array $values = null): static
    {
        return new static();
    }

    public function __construct()
    {
        parent::__construct();

        $this->valueStore = Valuestore::make(storage_path('app/updatesRepositories.json'));
    }

    public function getNames(): array
    {
        return Arr::wrap($this->valueStore->get('updatedRepositoryNames') ?? []);
    }

    public function store(string $name): self
    {
        $updatedRepositoryNames = $this->valueStore->get('updatedRepositoryNames', []);

        $updatedRepositoryNames[] = $name;

        $this->valueStore->put('updatedRepositoryNames', array_unique($updatedRepositoryNames));

        return $this;
    }

    public function flush(): static
    {
        return $this->setContent([]);
    }
}
