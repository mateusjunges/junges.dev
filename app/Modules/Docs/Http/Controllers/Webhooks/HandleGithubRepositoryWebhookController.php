<?php

namespace App\Modules\Docs\Http\Controllers\Webhooks;

use App\Concerns\GitHub\AuthorizesGithubWebhookRequest;
use App\Contracts\HandleGitHubWebhookRequest;
use App\Modules\Docs\ValueStores\UpdatedRepositoriesValueStore;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class HandleGithubRepositoryWebhookController implements HandleGitHubWebhookRequest
{
    use AuthorizesGithubWebhookRequest;

    public function handle(Request $request): ?JsonResponse
    {
        $this->authorize($request);

        $payload = $request->all();

        $updatedRepositoryName = $payload['repository']['full_name'] ?? null;

        if ($updatedRepositoryName === null) {
            return null;
        }

        UpdatedRepositoriesValueStore::make()->store($updatedRepositoryName);

        return response()->json(['message' => 'OK']);
    }
}
