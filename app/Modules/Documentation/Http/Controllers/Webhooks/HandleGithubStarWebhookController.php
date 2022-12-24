<?php

namespace App\Modules\Documentation\Http\Controllers\Webhooks;

use App\Modules\Documentation\Http\Requests\Github\GithubWebhookRequest;
use App\Modules\Documentation\Models\Repository;

class HandleGithubStarWebhookController
{
    public function __invoke(GithubWebhookRequest $request): void
    {
        $payload = $request->all();

        /** @var Repository $repository */
        $repository = Repository::query()->whereName($payload['repository']['name'])->first();

        $repository->update([
            'stars' => $payload['repository']['stargazers_count']
        ]);
    }
}
