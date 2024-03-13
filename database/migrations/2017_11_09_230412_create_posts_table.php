<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog__posts', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignIdFor(\App\Modules\Auth\Models\User::class, 'submitted_by_user_id')
                ->nullable()
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->boolean('original_content')->default(false);
            $table->string('title');
            $table->string('slug');
            $table->string('series_slug')->nullable();
            $table->string('preview_secret');
            $table->longText('text')->nullable();
            $table->longText('html')->nullable();
            $table->string('external_url')->nullable();
            $table->string('tweet_url')->nullable();
            $table->datetime('publish_date')->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('send_automated_tweet')->default(true);
            $table->boolean('tweet_sent')->default(false);
            $table->boolean('posted_on_medium')->default(false);
            $table->string('author')->default('Mateus Junges');
            $table->string('author_twitter_handle')->nullable();
            $table->timestamps();

            $table->index('series_slug');
        });
    }
};
