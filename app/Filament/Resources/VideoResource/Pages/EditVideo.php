<?php

declare(strict_types=1);

namespace App\Filament\Resources\VideoResource\Pages;

use App\Filament\Resources\VideoResource;
use Filament\Resources\Pages\EditRecord;

final class EditVideo extends EditRecord
{
    protected static string $resource = VideoResource::class;
}
