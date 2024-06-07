<?php

declare(strict_types=1);

namespace App\Modules\Docs\Support;

use Illuminate\Support\Collection;

final readonly class Alias
{
    public function __construct(
        public string $slug,
        public string $slogan,
        public string $branch,
        public string $githubUrl,
        public Collection $pages
    ) {
    }
}
