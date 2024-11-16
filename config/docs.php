<?php

return [
    'repositories' => [
        [
            'name' => 'laravel-kafka',
            'repository' => 'mateusjunges/laravel-kafka',
            'branches' => [
                // branch => version
                'v1.13.x' => 'v1.13',
                'master' => 'v2.0',
            ],
            'category' => 'Laravel',
        ],
    ],

    'valuestore' => [
        'driver' => 'file',
        'filename' => storage_path('app/updatesRepositories.json'),
    ],
];
