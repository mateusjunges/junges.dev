<?php

declare(strict_types=1);

namespace App\Modules\Advertising\Http\Controllers;

use App\Concerns\GitHub\AuthorizesGithubWebhookRequest;
use App\Contracts\HandleGitHubWebhookRequest;
use App\Modules\Advertising\Models\Sponsor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

final class HandleSponsorshipWebhookController implements HandleGitHubWebhookRequest
{
    use AuthorizesGithubWebhookRequest;

    public function handle(Request $request): JsonResponse
    {
        $this->authorize($request);

        $action = $request->input('action');

        return match (strtolower($action)) {
            'created' => $this->handleSponsorshipCreated($request),
            default => response()->json('Not interested in this event yet.'),
        };
    }

    private function handleSponsorshipCreated(Request $request): JsonResponse
    {
        $sponsor = new Sponsor();
        $sponsor->github_username = $request->input('sponsorship.sponsor.login');
        $sponsor->website = "https://github.com/$sponsor->github_username";
        $sponsor->github_avatar_url = $request->input('sponsorship.sponsor.avatar_url');
        $sponsor->name = $request->input('sponsorship.sponsor.name');
        $sponsor->alt_text = "The $sponsor->name logo";
        $sponsor->monthly_price_in_dollars = $request->input('sponsorship.tier.monthly_price_in_dollars');
        $sponsor->started_sponsoring_at = Carbon::parse($request->input('sponsorship.created_at'));
        $sponsor->save();

        return response()->json(['message' => 'Sponsor created.']);
    }
}
