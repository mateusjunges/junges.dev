<?php

return [

    'stripe' => [
        'model' => \App\Modules\Auth\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
];
