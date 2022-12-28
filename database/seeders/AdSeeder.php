<?php

namespace Database\Seeders;

use App\Modules\Advertising\Models\Ad;
use Illuminate\Database\Seeder;

final class AdSeeder extends Seeder
{
    public function run()
    {
        Ad::factory()->times(10)->create();
    }
}
