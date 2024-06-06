<?php declare(strict_types=1);

namespace App\Modules\Products\Http\Controllers;

use App\Modules\Products\Models\PairingSession;
use App\Notifications\PairingSessionBooked;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class SuccessfulCheckoutController
{
    public function __invoke(Request $request): RedirectResponse
    {
        $pairingSession = PairingSession::query()
            ->with(['product', 'customer'])
            ->find($request->input('pairing_session'));

        if ($pairingSession instanceof PairingSession) {
            $pairingSession->markAsPaid();

            $pairingSession->customer->notify(new PairingSessionBooked($pairingSession->product));

            return redirect()->route('thank-you', $pairingSession->product);
        }

        abort(404);
    }
}