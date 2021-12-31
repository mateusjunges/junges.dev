<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Github\RepositoryWebhookRequest;
use App\Support\ValueStores\UpdatedRepositoriesValueStore;
use Illuminate\Http\Request;

class HandleGithubWebhookController
{
    public function __invoke(RepositoryWebhookRequest $request)
    {
        $payload = json_decode($request->getContent(), true);

        $updatedRepositoryName = $payload['repository']['full_name'] ?? null;

        if ($updatedRepositoryName === null) {
            return;
        }

        UpdatedRepositoriesValueStore::make()->store($updatedRepositoryName);
    }
}
