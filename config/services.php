<?php

return [

    'twitter' => [
        'consumer_key' => env('TWITTER_CONSUMER_KEY'),
        'consumer_secret' => env('TWITTER_CONSUMER_SECRET'),
        'access_token' => env('TWITTER_ACCESS_TOKEN'),
        'access_token_secret' => env('TWITTER_ACCESS_TOKEN_SECRET'),
    ],

    'mastodon' => [
        'token' => env('MASTODON_TOKEN'),
    ],

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
        'scheme' => 'https',
    ],

    'media-library' => [
        'salt' => env('MEDIA_LIBRARY_PATH_GENERATOR_SALT'),
    ],

];
