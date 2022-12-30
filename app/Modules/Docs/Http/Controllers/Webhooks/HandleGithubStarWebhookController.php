<?php

namespace App\Modules\Docs\Http\Controllers\Webhooks;

use App\Concerns\GitHub\AuthorizesGithubWebhookRequest;
use App\Contracts\HandleGitHubWebhookRequest;
use App\Modules\Docs\Models\Repository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class HandleGithubStarWebhookController implements HandleGitHubWebhookRequest
{
    use AuthorizesGithubWebhookRequest;
    public function handle(Request $request): ?JsonResponse
    {
        $this->authorize($request);

        $payload = $request->all();

        /** @var Repository $repository */
        $repository = Repository::query()->whereName($payload['repository']['name'])->first();

        $repository->stars = $payload['repository']['stargazers_count'];
        $repository->save();

        return response()->json(['message' => 'OK']);
    }
}
