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
                'dev' => 'Development'
            ],
            'category' => 'Laravel',
        ],
        [
            'name' => 'laravel-acl',
            'repository' => 'mateusjunges/laravel-acl',
            'branches' => [
                'master' => 'v4',
            ],
            'category' => 'Laravel',
        ],
        [
            'name' => 'trackable-jobs-for-laravel',
            'repository' => 'mateusjunges/trackable-jobs-for-laravel',
            'branches' => [
                'v1.6.x' => 'v1.6',
                'master' => 'v2',
            ],
            'category' => 'Laravel',
        ],
    ],

    'valuestore' => [
        'driver' => 'file',
        'filename' => storage_path('app/updatesRepositories.json'),
    ],
];
