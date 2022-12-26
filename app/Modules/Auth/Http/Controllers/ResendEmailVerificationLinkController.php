<?php declare(strict_types=1);

namespace App\Modules\Auth\Http\Controllers;

final class ResendEmailVerificationLinkController
{
    public function __invoke()
    {
        auth()->user()->sendEmailVerificationNotification();

        flash()->success('Verification email sent!');

        return back();
    }
}
