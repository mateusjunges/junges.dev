<?php

namespace App\Contracts;

interface Twitter
{
    public function tweet(string $status): array|bool;
}
