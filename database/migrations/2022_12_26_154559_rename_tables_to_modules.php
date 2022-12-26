<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('repositories', 'docs__repositories');
        Schema::rename('authors', 'blog__authors');
        Schema::rename('posts', 'blog__posts');
        Schema::rename('series', 'blog__series');
        Schema::rename('links', 'blog__links');
    }

    public function down()
    {
        Schema::rename('docs__repositories', 'repositories');
        Schema::rename('blog__authors', 'authors');
        Schema::rename('blog__posts', 'posts');
        Schema::rename('blog__series', 'series');
        Schema::rename('blog__links', 'links');
    }
};
