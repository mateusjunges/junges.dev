<?php

declare(strict_types=1);

namespace App\Modules\Docs\ValueStores\Drivers;

use App\Modules\Docs\Contracts\ValueStoreDriver;

final class ArrayValueStoreDriver implements ValueStoreDriver
{
    private static array $store = [];

    public function getNames(): array
    {
        return self::$store['updatedRepositoryNames'] ?? [];
    }

    public function store(string $name): ValueStoreDriver
    {
        self::$store['updatedRepositoryNames'][] = $name;

        return $this;
    }

    public function flush(): void
    {
        self::$store = [];
    }
}
