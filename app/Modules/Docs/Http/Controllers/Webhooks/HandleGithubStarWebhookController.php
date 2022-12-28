<?php

namespace App\Modules\Docs\Http\Controllers\Webhooks;

use App\Modules\Docs\Http\Requests\GithubWebhookRequest;
use App\Modules\Docs\Models\Repository;

final class HandleGithubStarWebhookController
{
    public function __invoke(GithubWebhookRequest $request): void
    {
        $payload = $request->all();

        /** @var Repository $repository */
        $repository = Repository::query()->whereName($payload['repository']['name'])->first();

        $repository->stars = $payload['repository']['stargazers_count'];
        $repository->save();
    }
}
