<?php

namespace App\Http\Requests\Github;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class RepositoryWebhookRequest extends FormRequest
{
    public function authorize(): bool
    {
        $signature = $this->header('X-Hub-Signature');

        if ($signature === null) {
            throw new BadRequestException('Signature header is not set.');
        }

        $signatureParts = explode('=', $signature);

        if (count($signatureParts) !== 2) {
            throw new BadRequestException('Invalid signature format.');
        }

        $knownSignature = hash_hmac('sha1', $this->getContent(), config('services.github.webhook_secret'));

        if (! hash_equals($knownSignature, $signatureParts[1])) {
            throw new UnauthorizedException('Could not verify the request signature: '. $signatureParts[1]);
        }

        return true;
    }

    public function rules(): array
    {
        return [];
    }
}