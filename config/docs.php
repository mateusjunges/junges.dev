<?php

return [
    "repositories" => [
        [
            "name" => "laravel-kafka",
            "repository" => "mateusjunges/laravel-kafka",
            "branches" => [
                "v1.6.x" => "v1.6",
                "v1.7.x" => "v1.7",
                "v1.8.x" => "v1.8",
                "v1.9.x" => "v1.9",
                "v1.10.x" => "v1.10",
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
            ],
            "category" => "Laravel"
        ]
    ],

    'valuestore' => [
        'driver' => 'file',
        'filename' => storage_path('app/updatesRepositories.json'),
    ],
];
