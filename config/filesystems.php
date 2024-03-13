<?php

return [

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    'disks' => [
        'sponsors' => [
            'driver' => 'local',
            'root' => storage_path('app/public/sponsors'),
            'url' => env('APP_URL').'/storage/sponsors',
            'visibility' => 'public',
        ],

        'og-images' => [
            'driver' => 'local',
            'root' => storage_path('app/public/og-images'),
            'url' => env('APP_URL').'/storage/og-images',
        ],

        'admin-uploads' => [
            'driver' => 'local',
            'root' => storage_path('app/public/admin-uploads'),
            'url' => env('APP_URL').'/storage/admin-uploads',
            'visibility' => 'public',
        ],
    ],

];
