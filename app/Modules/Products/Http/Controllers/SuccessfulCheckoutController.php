<?php declare(strict_types=1);

namespace App\Modules\Products\Http\Controllers;

use App\Modules\Products\Models\PairingSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class SuccessfulCheckoutController
{
    public function __invoke(Request $request): RedirectResponse
    {
        $pairingSession = PairingSession::query()->find($request->input('pairing_session'));

        if ($pairingSession instanceof PairingSession) {
            $pairingSession->markAsPaid();

            return redirect()->route('thank-you');
        }

        abort(404);
    }
}