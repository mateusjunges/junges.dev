<?php declare(strict_types=1);

namespace App\Modules\Products\Http\Controllers;

use App\Modules\Products\Models\Customer;
use App\Modules\Products\Models\PairingSession;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Requests\CheckoutProductRequest;
use Illuminate\Support\Facades\URL;
use Laravel\Cashier\Checkout;

final class CheckoutProductController
{
    public function store(CheckoutProductRequest $request): Checkout
    {
        $customer = Customer::query()->firstOrCreate(
            attributes: ['email' => $request->input('email')],
            values: ['name' => $request->input('name')]
        );

        assert($customer instanceof Customer);

        $product = Product::query()->where('stripe_product_id', $request->input('stripe_product_id'))->first();
        assert($product instanceof Product);

        $pairingSession = PairingSession::query()->create([
            'customer_id' => $customer->id,
            'product_id' => $product->id
        ]);
        assert($pairingSession instanceof PairingSession);

        return $customer->checkout([$request->input('stripe_price_id') => 1], [
            'success_url' => URL::temporarySignedRoute('checkout.success', now()->addMinutes(5), ['pairing_session' => $pairingSession->id]),
            'cancel_url' => URL::temporarySignedRoute('checkout.failed', now()->addMinutes(5), ['pairing_session' => $pairingSession->id]),
            'metadata' => [
                'pairing_session_id' => $pairingSession->id,
            ]
        ]);
    }
}