<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    public function run()
    {
        User::query()->create([
            'name' => 'Mateus Junges',
            'email' => 'mateus@junges.dev',
            'password' => bcrypt('password'),
            'admin' => true,
        ]);

        User::factory()->count(10)->create();
    }
}
