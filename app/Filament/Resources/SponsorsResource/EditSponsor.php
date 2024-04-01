<?php

declare(strict_types=1);

namespace App\Filament\Resources\SponsorsResource;

use App\Filament\Resources\SponsorsResource;
use Filament\Resources\Pages\EditRecord;

final class EditSponsor extends EditRecord
{
    protected static string $resource = SponsorsResource::class;
}
