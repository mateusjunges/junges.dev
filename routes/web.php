<?php declare(strict_types=1);

use App\Http\Controllers\HireMeController;
use App\Http\Controllers\UsesController;
use App\Modules\Auth\Http\Controllers\ForgotPasswordController;
use App\Modules\Auth\Http\Controllers\LoginController;
use App\Modules\Auth\Http\Controllers\RegisterController;
use App\Modules\Auth\Http\Controllers\ResendVerificationMailController;
use App\Modules\Auth\Http\Controllers\ResetPasswordController;
use App\Modules\Blog\Http\Controllers\Links\IndexController;
use App\Modules\Blog\Http\Controllers\Links\LinkApproval;
use App\Modules\Blog\Http\Controllers\Links\LinkController;
use App\Modules\Blog\Http\Controllers\OgImageController;
use App\Modules\Blog\Http\Controllers\ShowPostController;
use App\Modules\Docs\Http\Controllers\DocsController;
use App\Modules\Home\Http\Controllers\HomeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::middleware('web')->group(static function () {
    Route::get('/', HomeController::class)->name('home');
    Route::view('/about', 'front.about')->name('about');
    Route::redirect('/admin', '/admin/posts')->name('admin');
    Route::get('hire-me', HireMeController::class)->name('hire-me');

    // Docs
    Route::get('documentation', [DocsController::class, 'index'])->name('docs.index');
    Route::get('documentation/{repository}/{alias?}', [DocsController::class, 'repository'])->name('docs.repository');
    Route::get('documentation/{repository}/{alias}/{slug}', [DocsController::class, 'show'])->where('slug', '.*')->name('docs.page');

    // Links
     Route::get('links/{link}/approve', [LinkApproval::class, 'approve'])->name('link.approve');
     Route::get('links/{link}/approve-and-create-post', [LinkApproval::class, 'approveAndCreatePost'])->name('link.approve-and-create-post');
     Route::get('links/{link}/reject', [LinkApproval::class, 'reject'])->name('link.reject');

     Route::middleware(['auth', 'verified', 'doNotCacheResponse'])->group(static function () {
         Route::get('/links', IndexController::class)->name('links.index');
         Route::get('/links/create', [LinkController::class, 'create'])->name('links.create');
         Route::post('/links', [LinkController::class, 'store'])->name('links.store');
         Route::view('thanks', 'front.links.thanks')->name('links.thanks');
     });

     // Auth (guest)
     Route::middleware(['guest', 'doNotCacheResponse'])->group(static function () {
         Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
         Route::post('login', [LoginController::class, 'login']);

         Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
         Route::post('register', [RegisterController::class, 'register'])->middleware(ProtectAgainstSpam::class);

         Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
         Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
         Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
         Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
     });

     // Auth (authenticated)
    Route::middleware(['web', 'auth'])->group(static function () {
        Route::view('/email/verify', 'auth.verify-email')->name('verification.notice');
        Route::post('email/verify/send-link-again', ResendVerificationMailController::class)->name('verification.resend');
        Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
            $request->fulfill();

            return view('auth.verified');
        })->name('verification.verify');

        Route::match(['post', 'get'], 'logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('health', HealthCheckResultsController::class);
    });

    // Advertising
    Route::view('advertising', 'front.advertising')->name('advertising.index');

    // Blog (this must be the last one, because it uses some wildcards)
    Route::get('uses', UsesController::class)->name('uses');
    Route::get('{post}/og-image', OgImageController::class)->name('post.ogImage');
    Route::get('{postSlug}', ShowPostController::class)->name('post');
});
