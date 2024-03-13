<?php

namespace Database\Seeders;

use App\Modules\Blog\Models\Link;
use Illuminate\Database\Seeder;

final class LinkSeeder extends Seeder
{
    public function run(): void
    {
        Link::factory()->times(50)->create();
    }
}
