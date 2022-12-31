<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

final class VerifyCsrfToken extends Middleware
{
    protected $addHttpCookie = true;

    protected $except = [
        'webhook-webmentions',
        'mailgun-feedback',
    ];
}
