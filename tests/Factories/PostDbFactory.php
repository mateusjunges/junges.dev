<?php

namespace Tests\Factories;

use App\Modules\Blog\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostDbFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'text' => $this->faker->paragraph(),
            'publish_date' => $this->faker->boolean(50) ? $this->faker->dateTimeBetween('-5 years') : null,
            'published' => true,
            'original_content' => $this->faker->boolean(10),
        ];
    }
}
