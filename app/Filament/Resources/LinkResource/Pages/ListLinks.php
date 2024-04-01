<?php

declare(strict_types=1);

namespace App\Filament\Resources\LinkResource\Pages;

use App\Filament\Resources\LinkResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\CreateAction;

final class ListLinks extends ListRecords
{
    protected static string $resource = LinkResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
