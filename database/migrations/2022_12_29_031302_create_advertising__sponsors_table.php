<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advertising__sponsors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alt_text');
            $table->string('logo_url');
            $table->string('sponsor_tier');
            $table->timestamp('started_sponsoring_at');
            $table->timestamp('stop_sponsoring_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('advertising__sponsors');
    }
};
