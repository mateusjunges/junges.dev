<?php declare(strict_types=1);

namespace App\Modules\Products\Http\Controllers;

use App\Modules\Products\Models\PairingSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class FailedCheckoutController
{
    public function __invoke(Request $request): RedirectResponse
    {
        $pairingSession = PairingSession::query()
            ->with('product')
            ->find($request->input('pairing_session'));

        if ($pairingSession instanceof PairingSession) {
            return redirect()->route('checkout-failure', $pairingSession->product);
        }

        abort(404);
    }
}