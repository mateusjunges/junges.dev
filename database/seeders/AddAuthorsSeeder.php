<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AddAuthorsSeeder extends Seeder
{
    public function run()
    {
        Author::create([
            'name' => 'Mateus Junges',
            'personal_website' => 'https://junges.dev',
            'twitter_username' => 'mateusjungess'
        ]);
    }
}
