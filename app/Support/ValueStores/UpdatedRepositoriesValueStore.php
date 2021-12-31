<?php

namespace App\Support\ValueStores;

use Illuminate\Support\Arr;
use Spatie\Valuestore\Valuestore;

class UpdatedRepositoriesValueStore extends Valuestore
{
    protected Valuestore $valueStore;

    public static function make(string $fileName = 'updatesRepositories', array $values = null): self
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

    public function flush(): void
    {
        $this->valueStore->flush();
    }
}
