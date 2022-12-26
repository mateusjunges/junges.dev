<?php declare(strict_types=1);

namespace App\Modules\Auth\Http\Controllers;

use Illuminate\Contracts\View\View;

final class PromptEmailVerificationViewController
{
    public function __invoke(): View
    {
        return view('modules.auth.verify-email');
    }
}
