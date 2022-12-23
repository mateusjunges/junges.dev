<?php

namespace App\Modules\Posts\Contracts;

interface Sluggable
{
    public function getSluggableValue(): string;
}
