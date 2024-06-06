<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->string('price_currency');
            $table->string('price_currency_symbol');
            $table->string('stripe_product_id');
            $table->string('stripe_price_id');
            $table->string('stripe_price_lookup_key');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->timestamps();
        });
    }
};
