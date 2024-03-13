<?php

namespace Tests\Factories;

use App\Modules\Advertising\Models\Ad;
use Illuminate\Database\Eloquent\Factories\Factory;

final class AdFactory extends Factory
{
    protected $model = Ad::class;

    public function definition(): array
    {
        $startsAt = now()->addDays(random_int(-30, 30));
        $endsAt = $startsAt->copy()->addDays(30);

        return [
            'display_on_url' => $this->faker->boolean(50) ? $this->faker->url() : '',
            'text' => $this->faker->sentence(),
            'starts_at' => $startsAt->toDateString(),
            'ends_at' => $endsAt->toDateString(),
        ];
    }
}
