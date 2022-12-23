<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Tests\Factories\PostFactory;

class PostsSeeder extends Seeder
{
    public function run()
    {
        (new PostFactory(2))->tweet()->create();
        (new PostFactory(2))->original()->create();
        (new PostFactory(2))->link()->create();

        PostFactory::series(10);
    }
}
