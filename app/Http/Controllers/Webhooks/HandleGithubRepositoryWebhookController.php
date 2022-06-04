<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Github\GithubWebhookRequest;
use App\Support\ValueStores\UpdatedRepositoriesValueStore;
use Illuminate\Http\Request;

class HandleGithubRepositoryWebhookController
{
    public function __invoke(GithubWebhookRequest $request): void
    {
        $payload = json_decode($request->getContent(), true);

        $updatedRepositoryName = $payload['repository']['full_name'] ?? null;

        if ($updatedRepositoryName === null) {
            return;
        }

        UpdatedRepositoriesValueStore::make()->store($updatedRepositoryName);
    }
}
