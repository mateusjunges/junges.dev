<?php

namespace Tests\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostDatabaseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'text' => $this->faker->paragraph,
            'publish_date' => $this->faker->boolean(50) ? $this->faker->dateTimeBetween('-5 years') : null,
            'published' => true,
            'original_content' => $this->faker->boolean(10),
        ];
    }
}
