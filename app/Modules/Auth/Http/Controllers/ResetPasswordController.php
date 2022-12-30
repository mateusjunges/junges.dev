<?php declare(strict_types=1);

namespace App\Modules\Auth\Http\Controllers;

use App\Modules\Blog\Http\Controllers\Links\IndexController;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;

final class ResetPasswordController
{
    use ResetsPasswords, ValidatesRequests;

    public function redirectPath(): string|RedirectResponse
    {
        if (auth()->user()->admin) {
            return '/admin';
        }

        return redirect()->to(action(IndexController::class));
    }
}
