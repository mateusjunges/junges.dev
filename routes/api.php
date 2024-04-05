<?php declare(strict_types=1);

use App\Modules\Advertising\Http\Controllers\HandleSponsorshipWebhookController;
use App\Modules\Docs\Http\Controllers\Webhooks\HandleGithubRepoForkedWebhookController;
use App\Modules\Docs\Http\Controllers\Webhooks\HandleGithubRepositoryWebhookController;
use App\Modules\Docs\Http\Controllers\Webhooks\HandleGithubStarWebhookController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(static function () {
    Route::post('api/webhooks/github', [HandleGithubRepositoryWebhookController::class, 'handle'])->name('api.docs.webhooks.github.repository');
    Route::post('api/webhooks/github/repo-starred', [HandleGithubStarWebhookController::class, 'handle'])->name('api.docs.webhooks.github.repo-starred');
    Route::post('api/webhooks/github/repo-forked', [HandleGithubRepoForkedWebhookController::class, 'handle'])->name('api.docs.webhooks.github.repo-forked');

    Route::post('api/advertising/webhooks/github/sponsors', [HandleSponsorshipWebhookController::class, 'handle'])->name('api.advertising.webhooks.github.sponsors');
});