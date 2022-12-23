<?php

namespace App\Models\Contracts;

interface Sluggable
{
    public function getSluggableValue(): string;
}
