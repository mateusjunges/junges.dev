<?php

namespace Database\Seeders;

use App\Modules\Blog\Models\Author;
use Illuminate\Database\Seeder;

final class AddAuthorsSeeder extends Seeder
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
