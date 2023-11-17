<?php

return [
    "repositories" => [
        [
            "name" => "laravel-kafka",
            "repository" => "mateusjunges/laravel-kafka",
            "branches" => [
                // branch => version
                "v1.10.x" => "v1.10",
                "v1.11.x" => "v1.11",
                "v1.12.x" => "v1.12",
                "v1.13.x" => "v1.13",
                "v2.x" => "v2.0"
            ],
            "category" => "Laravel"
        ],
        [
            "name" => "laravel-acl",
            "repository" => "mateusjunges/laravel-acl",
            "branches" => [
                "master" => "v4"
            ],
            "category" => "Laravel"
        ],
        [
            "name" => "trackable-jobs-for-laravel",
            "repository" => "mateusjunges/trackable-jobs-for-laravel",
            "branches" => [
                "v1.5.x" => "v1.5",
                "v1.6.x" => "v1.6"
            ],
            "category" => "Laravel"
        ]
    ],

    'valuestore' => [
        'driver' => 'file',
        'filename' => storage_path('app/updatesRepositories.json'),
    ],
];
