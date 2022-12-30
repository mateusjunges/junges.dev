<?php declare(strict_types=1);

namespace App\Modules\Advertising\Http\Controllers;

use Illuminate\Http\JsonResponse;

final class HandleSponsorshipWebhookController
{
    public function __invoke(): JsonResponse
    {

        return response()->json(['message' => 'OK']);
    }
}
