<?php

namespace App\Modules\Documentation\Http\Controllers\Webhooks;

use App\Modules\Documentation\Http\Requests\Github\GithubWebhookRequest;
use App\Support\ValueStores\UpdatedRepositoriesValueStore;

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