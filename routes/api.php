<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('webhooks')->group(function() {
    Route::post('github', \App\Http\Controllers\Webhooks\HandleGithubRepositoryWebhookController::class);
});
