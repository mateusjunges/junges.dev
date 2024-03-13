<?php

declare(strict_types=1);

namespace App\Modules\Docs\ValueStores\Drivers;

use App\Modules\Docs\Contracts\ValueStoreDriver;
use Illuminate\Support\Arr;
use Spatie\Valuestore\Valuestore;

final class FileValueStoreDriver implements ValueStoreDriver
{
    public function __construct(
        private readonly Valuestore $store,
    ) {
    }

    public function getNames(): array
    {
        return Arr::wrap($this->store->get('updatedRepositoryNames', []));
    }

    public function store(string $name): ValueStoreDriver
    {
        $updatedRepositoryNames = $this->store->get('updatedRepositoryNames', []);

        $updatedRepositoryNames[] = $name;

        $this->store->put('updatedRepositoryNames', array_unique($updatedRepositoryNames));

        return $this;
    }

    public function flush(): void
    {
        $this->store->flush();
    }
}
