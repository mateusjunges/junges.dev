<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('advertising__sponsors', function (Blueprint $table) {
            $table->after('name', function (Blueprint $table) {
                $table->string('github_username')->nullable();
                $table->string('github_avatar_url')->nullable();
            });
            $table->renameColumn('sponsor_tier', 'monthly_price_in_dollars');
        });
    }
};
