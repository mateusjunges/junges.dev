<?php declare(strict_types=1);

namespace App\Modules\Docs\ValueStores;

use App\Modules\Docs\Contracts\ValueStoreDriver;

final class UpdatedRepositoriesValueStore
{
    protected ValueStoreDriver $driver;

    public static function make(): self
    {
        return new self();
    }

    public function __construct()
    {
        $this->driver = resolve(ValueStoreDriver::class);
    }

    public function getNames(): array
    {
        return $this->driver->getNames();
    }

    public function store(string $name): ValueStoreDriver
    {
        return $this->driver->store($name);
    }

    public function flush(): void
    {
        $this->driver->flush();
    }
}
