<?php declare(strict_types=1);

namespace App\Filament\Resources\VideoResource\Pages;

use App\Filament\Resources\VideoResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateVideo extends CreateRecord
{
    protected static string $resource = VideoResource::class;
}
