<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Tests\Factories\TagFactory;

final class TagSeeder extends Seeder
{
    public function run(): void
    {
        TagFactory::times(20)->create();
    }
}
