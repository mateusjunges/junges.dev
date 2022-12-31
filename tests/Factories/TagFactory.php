<?php

namespace Tests\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Tags\Tag;

final class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
        ];
    }
}
