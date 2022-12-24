<?php

namespace Tests\Factories;

use App\Modules\Documentation\Models\Repository;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepositoryFactory extends Factory
{
    protected $model = Repository::class;

    public function definition(): array
    {
        return [
            'name' => 'repository-name',
            'description' => null,
            'topics' => null,
            'stars' => 0,
            'language' => 'php'
        ];
    }
}
