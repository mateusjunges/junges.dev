<?php

declare(strict_types=1);

namespace App\Filament\Resources\SponsorsResource;

use App\Filament\Resources\SponsorsResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateSponsor extends CreateRecord
{
    protected static string $resource = SponsorsResource::class;
}
