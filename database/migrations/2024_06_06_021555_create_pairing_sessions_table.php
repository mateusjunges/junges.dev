<?php declare(strict_types=1);

use App\Modules\Products\Models\Customer;
use App\Modules\Products\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pairing_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class, 'customer_id')->constrained('customers');
            $table->foreignIdFor(Product::class, 'product_id')->constrained('products');
            $table->dateTime('paid_at')->nullable();
            $table->dateTime('scheduled_to')->nullable();
            $table->timestamps();
        });
    }
};
