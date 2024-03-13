<?php

declare(strict_types=1);

namespace App\Modules\Docs\Enums;

/** @psalm-immutable */
enum RepositoryType: string
{
    case PACKAGE = 'package';
    case PROJECT = 'project';
}
