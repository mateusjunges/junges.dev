<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'twitter' => [
        'consumer_key' => env('TWITTER_CONSUMER_KEY'),
        'consumer_secret' => env('TWITTER_CONSUMER_SECRET'),
        'access_token' => env('TWITTER_ACCESS_TOKEN'),
        'access_token_secret' => env('TWITTER_ACCESS_TOKEN_SECRET'),
    ],

    'mastodon' => [
        'token' => env('MASTODON_TOKEN'),
    ],

    // Github
    'github' => [
        'webhook_secret' => env('GITHUB_WEBHOOK_SECRET'),
        'docs_access_token' => env('GITHUB_DOCS_ACCESS_TOKEN'),
        'token' => env('GITHUB_TOKEN'),
        'username' => env('GITHUB_USERNAME', 'mateusjunges'),
        'should_verify_webhook_signature' => true,
    ],

    'stripe' => [
        'model' => \App\Modules\Auth\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'media-library' => [
        'salt' => env('MEDIA_LIBRARY_PATH_GENERATOR_SALT'),
    ],
];
