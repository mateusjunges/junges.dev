<?php declare(strict_types=1);

namespace App\Modules\Auth\Routing\Registrars;

use App\Contracts\RouteRegistrar;
use App\Modules\Auth\Http\Controllers\ForgotPasswordController;
use App\Modules\Auth\Http\Controllers\LoginController;
use App\Modules\Auth\Http\Controllers\PromptEmailVerificationViewController;
use App\Modules\Auth\Http\Controllers\RegisterController;
use App\Modules\Auth\Http\Controllers\ResendEmailVerificationLinkController;
use App\Modules\Auth\Http\Controllers\ResetPasswordController;
use Illuminate\Contracts\Routing\Registrar;
use Spatie\Honeypot\ProtectAgainstSpam;

final class AuthRouteRegistrar implements RouteRegistrar
{
    public function map(Registrar $router): void
    {
        $router->get('/email/verify', PromptEmailVerificationViewController::class)
            ->middleware('auth')
            ->name('verification.notice');

        $router->get('/email/verify/send-link-again', ResendEmailVerificationLinkController::class)
            ->middleware('auth')
            ->name('verification.resend');

        $router->group(
            attributes: [
                'middleware' => ['guest'],
            ],
            routes: function(Registrar $router) {
                $router->get('login', [LoginController::class, 'showLoginForm'])->name('login');
                $router->post('login', [LoginController::class, 'login']);

                $router->get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
                $router->post('register', [RegisterController::class, 'register'])->middleware(ProtectAgainstSpam::class);

                $router->get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
                $router->post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
                $router->get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
                $router->post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
            }
        );
    }
}
