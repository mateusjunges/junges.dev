<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('docs__repositories', function (Blueprint $table) {
            $table->after('stars', function (Blueprint $table) {
                $table->string('documentation_url')->nullable();
                $table->integer('downloads')->default(0);
            });
        });
    }
};
