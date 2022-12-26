<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
//            RepositoriesSeeder::class,
            PostsSeeder::class,
            UpdatesRepositoriesDocumentationUrl::class,
        ]);
    }
}
