<?php declare(strict_types=1);

namespace App\Modules\Auth\Routing\Registrars;

use App\Contracts\RouteRegistrar;
use App\Modules\Auth\Http\Controllers\ForgotPasswordController;
use App\Modules\Auth\Http\Controllers\LoginController;
use App\Modules\Auth\Http\Controllers\RegisterController;
use App\Modules\Auth\Http\Controllers\ResendVerificationMailController;
use App\Modules\Auth\Http\Controllers\ResetPasswordController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;
use Spatie\Honeypot\ProtectAgainstSpam;

final class AuthRouteRegistrar implements RouteRegistrar
{
    public function map(Registrar $router): void
    {
        $router->group(
            attributes: [
                'middleware' => ['web', 'guest', 'doNotCacheResponse']
            ],
            routes: function (Registrar $router) {
                $router->get('login', [LoginController::class, 'showLoginForm'])->name('login');
                $router->post('login', [LoginController::class, 'login']);

                $router->get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
                $router->post('register', [RegisterController::class, 'register'])->middleware(ProtectAgainstSpam::class);

                $router->get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
                $router->post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
                $router->get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
                $router->post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
            },
        );

        $router->group(
            attributes: [
                'middleware' => ['web', 'auth']
            ],
            routes: function (Registrar $router) {
                $router->get('/email/verify', function () {
                    return view('auth.verify-email');
                })->middleware('auth')->name('verification.notice');

                $router->post('email/verify/send-link-again', ResendVerificationMailController::class)->name('verification.resend');

                $router->get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
                    $request->fulfill();

                    return view('auth.verified');
                })->middleware(['auth', 'signed'])->name('verification.verify');

                $router->match(['post', 'get'], 'logout', [LoginController::class, 'logout'])->name('logout');

                $router->get('health', HealthCheckResultsController::class)->middleware(['auth', 'admin']);
            }
        );
    }
}
