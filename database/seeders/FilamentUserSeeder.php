<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

final class FilamentUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->create([
            'email' => 'mateus@junges.dev',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'name' => 'Mateus Junges'
        ]);
    }
}
