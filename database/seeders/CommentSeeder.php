<?php

namespace Database\Seeders;

use App\Modules\Auth\Models\User;
use App\Modules\Blog\Models\Post;
use Illuminate\Database\Seeder;

final class CommentSeeder extends Seeder
{
    public function run()
    {
        Post::query()->each(function (Post $post) {
            if (faker()->boolean) {
                return;
            }

            foreach (range(1, random_int(1, 10)) as $i) {
                $user = User::all()->random();

                $post->comment(faker()->text, $user);
            }
        });
    }
}
