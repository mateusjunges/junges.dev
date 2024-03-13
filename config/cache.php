<?php

use Illuminate\Support\Str;

return [

    'stores' => [
        'docs' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/docs'),
        ],

        'markdown' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/markdown'),
        ],
    ],

];
