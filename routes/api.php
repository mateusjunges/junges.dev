<?php

use App\Http\Controllers\Webhooks\HandleGithubRepositoryWebhookController;
use App\Http\Controllers\Webhooks\HandleGithubStarWebhookController;
use Illuminate\Support\Facades\Route;

Route::prefix('webhooks')->group(function() {
    Route::prefix('github')->group(function() {
        Route::post('/', HandleGithubRepositoryWebhookController::class);
        Route::post('repo-starred', HandleGithubStarWebhookController::class);
    });
});
