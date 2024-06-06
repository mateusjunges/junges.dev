<?php

return [

    'mailers' => [
        'postmark' => [
            'transport' => 'postmark',
            'token' => env('POSTMARK_TOKEN'),
            'message_stream_id' => env('POSTMARK_MESSAGE_STREAM_ID'),
            // 'message_stream_id' => null,
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        'mailgun' => [
            'transport' => 'mailgun',
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        'mailcoach' => [
            'transport' => 'mailcoach',
            'domain' => 'personalpro.mailcoach.app',
            'token' => env('MAILCOACH_API_TOKEN'),
        ],

        'roundrobin' => [
            'transport' => 'roundrobin',
            'mailers' => [
                'ses',
                'postmark',
            ],
        ],
    ],

];
