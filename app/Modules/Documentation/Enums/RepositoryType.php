<?php

namespace App\Modules\Documentation\Enums;

/** @psalm-immutable */
enum RepositoryType: string
{
    case PACKAGE = 'package';
    case PROJECT = 'project';
}
