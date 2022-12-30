<?php declare(strict_types=1);

namespace App\Modules\Auth\Http\Controllers;

use Illuminate\Http\RedirectResponse;

final class ResendVerificationMailController
{
    public function __invoke(): RedirectResponse
    {
        auth()->user()->sendEmailVerificationNotification();

        flash()->success('Verification email sent!');

        return back();
    }
}
