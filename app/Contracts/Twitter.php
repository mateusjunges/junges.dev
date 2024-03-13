<?php

declare(strict_types=1);

namespace App\Contracts;

interface Twitter
{
    public function tweet(string $status): array|bool;
}
