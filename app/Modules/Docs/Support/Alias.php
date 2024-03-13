<?php

declare(strict_types=1);

namespace App\Modules\Docs\Support;

use Illuminate\Support\Collection;

final class Alias
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
