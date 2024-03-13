<?php

declare(strict_types=1);

namespace App\Concerns\GitHub;

use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

trait AuthorizesGithubWebhookRequest
{
    public function authorize(Request $request): bool
    {
        if (! config('services.github.should_verify_webhook_signature')) {
            return true;
        }

        $signature = $request->header('X-Hub-Signature');

        if ($signature === null) {
            throw new BadRequestException('Signature header is not set.');
        }

        $signatureParts = explode('=', $signature);

        if (count($signatureParts) !== 2) {
            throw new BadRequestException('Invalid signature format.');
        }

        $knownSignature = hash_hmac('sha1', $request->getContent(), config('services.github.webhook_secret'));

        if (! hash_equals($knownSignature, $signatureParts[1])) {
            throw new UnauthorizedException('Could not verify the request signature: '.$signatureParts[1]);
        }

        return true;
    }
}
