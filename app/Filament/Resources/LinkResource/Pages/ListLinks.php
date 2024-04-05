<?php

declare(strict_types=1);

namespace App\Filament\Resources\LinkResource\Pages;

use App\Filament\Resources\LinkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListLinks extends ListRecords
{
    protected static string $resource = LinkResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make()
        ];
    }
}
