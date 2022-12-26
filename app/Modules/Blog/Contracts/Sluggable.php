<?php

namespace App\Modules\Blog\Contracts;

interface Sluggable
{
    public function getSluggableValue(): string;
}
