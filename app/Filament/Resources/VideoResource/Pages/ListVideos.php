<?php

declare(strict_types=1);

namespace App\Filament\Resources\VideoResource\Pages;

use App\Filament\Resources\VideoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListVideos extends ListRecords
{
    protected static string $resource = VideoResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make()
        ];
    }
}
