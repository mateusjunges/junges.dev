<?php

namespace App\Modules\Docs\Contracts;

interface ValueStoreDriver
{
    public function getNames(): array;

    public function store(string $name): self;

    public function flush(): void;
}
