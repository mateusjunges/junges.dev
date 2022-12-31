<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserSeeder::class);
    }
}
