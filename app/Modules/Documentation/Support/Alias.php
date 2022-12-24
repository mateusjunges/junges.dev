<?php

namespace App\Modules\Documentation\Support;

use Illuminate\Support\Collection;

class Alias
{
    public function __construct(
        public readonly string $slug,
        public readonly string $slogan,
        public readonly string $branch,
        public readonly string $githubUrl,
        public readonly Collection $pages
    ) {
    }
}
