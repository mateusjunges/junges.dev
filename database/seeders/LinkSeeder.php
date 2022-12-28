<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Seeder;

final class LinkSeeder extends Seeder
{
    public function run()
    {
        Link::factory()->times(50)->create();
    }
}
