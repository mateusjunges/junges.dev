<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('repositories', function (Blueprint $table) {
            if (Schema::hasColumn('repositories', 'repository_created_at')) {
                return;
            }

            $table->timestamp('repository_created_at')->nullable();
        });
    }
};
