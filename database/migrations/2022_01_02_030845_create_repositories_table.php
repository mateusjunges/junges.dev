<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('docs__repositories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('topics')->nullable();
            $table->unsignedSmallInteger('forks')->default(0);
            $table->unsignedBigInteger('stars')->default(0);
            $table->string('language')->nullable();
            $table->dateTime('repository_created_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('docs__repositories');
    }
};
