<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface HandleGitHubWebhookRequest
{
    /** Authorizes the webhook request. */
    public function authorize(Request $request): bool;

    /** Handles the webhook request. */
    public function handle(Request $request): ?JsonResponse;
}
