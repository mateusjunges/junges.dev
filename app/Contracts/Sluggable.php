<?php

namespace App\Contracts;

interface Sluggable
{
    public function getSluggableValue(): string;
}
