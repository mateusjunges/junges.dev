<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('author')->default('Mateus Junges');
            $table->foreignId('submitted_by_user_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->string('title');
            $table->longText('html')->nullable();
            $table->longText('text')->nullable();
            $table->string('slug');
            $table->string('author_twitter_handle')->nullable();
            $table->string('preview_secret');
            $table->string('tweet_url')->nullable();
            $table->string('series_slug')->nullable();
            $table->string('external_url')->nullable();
            $table->datetime('publish_date')->nullable();
            $table->boolean('original_content')->default(false);
            $table->boolean('send_automated_tweet')->default(false);
            $table->boolean('published')->default(false);
            $table->boolean('tweet_sent')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
