<?php

namespace Database\Seeders;

use App\Modules\Products\Models\Product;
use Illuminate\Database\Seeder;

final class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        Product::query()->create([
            'name' => '1 hour pairing session',
            'price' => '17000',
            'price_currency' => 'USD',
            'price_currency_symbol' => '$',
            'stripe_product_id' => app()->isProduction() ? '' : 'prod_QEySNO6uJEFzTU',
            'stripe_price_id' => app()->isProduction() ? '' : 'price_1POUV9B6BgeF1nnz7maWCsJ9',
            'stripe_price_lookup_key' => '1-hour-pairing-session',
            'description' => "I'll pair with your team in a party of up to 3 people for 30 minutes."
        ]);

        Product::query()->create([
            'name' => '30 minutes pairing session',
            'price' => '9000',
            'price_currency' => 'USD',
            'price_currency_symbol' => '$',
            'stripe_product_id' => app()->isProduction() ? '' : 'prod_QEyP4a3wDSwM1L',
            'stripe_price_id' => app()->isProduction() ? '' : 'price_1POUT3B6BgeF1nnzpimQbX1x',
            'stripe_price_lookup_key' => '30-min-pairing-session',
            'description' => "I'll pair with your team in a party of up to 3 people for 30 minutes."
        ]);
    }
}
