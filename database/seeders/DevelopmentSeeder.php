<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DevelopmentSeeder extends Seeder
{
    public function run(): void
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
