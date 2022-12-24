<?php

return [
    'default_collection' => null,

    'collections' => [
        'docs' => [
            'disk' => 'docs',
            'sheet_class' => \App\Modules\Documentation\Sheets\DocumentationPage::class,
            'path_parser' => \App\Modules\Documentation\Services\DocumentationPathParser::class,
            'content_parser' => \App\Modules\Documentation\Services\DocumentationContentParser::class,
        ],
    ],
];
