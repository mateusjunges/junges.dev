<?php

namespace App\Contracts;

interface Sluggable
{
    public function getSluggableValue(): string;

    public function setSlug(string $slug): void;
}
