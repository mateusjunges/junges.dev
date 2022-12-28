<?php

namespace App\Modules\Docs\Http\Controllers\Webhooks;

use App\Modules\Docs\Http\Requests\GithubWebhookRequest;
use App\Modules\Docs\ValueStores\UpdatedRepositoriesValueStore;

final class HandleGithubRepositoryWebhookController
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
