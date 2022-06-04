<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Requests\Github\GithubWebhookRequest;
use App\Models\Repository;

class HandleGithubStarWebhookController
{
    public function __invoke(GithubWebhookRequest $request): void
    {
        $payload = json_decode($request->getContent(), true);

        /** @var Repository $repository */
        $repository = Repository::whereName($payload['repository']['name'])->first();

        $repository->update([
            'stars' => $payload['repository']['stargazers_count']
        ]);
    }
}
