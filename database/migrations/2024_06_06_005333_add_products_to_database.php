<?php declare(strict_types=1);

use Database\Seeders\ProductsSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', static function () {
            (new ProductsSeeder)->run();
        });
    }
};
