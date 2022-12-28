<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this
            ->call(UserSeeder::class)
            ->call(TagSeeder::class)
            ->call(PostSeeder::class)
            ->call(CommentSeeder::class)
            ->call(AdSeeder::class)
            ->call(LinkSeeder::class);
    }
}
