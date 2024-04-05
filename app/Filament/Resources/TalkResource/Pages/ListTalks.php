<?php

declare(strict_types=1);

namespace App\Filament\Resources\TalkResource\Pages;

use App\Filament\Resources\TalkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListTalks extends ListRecords
{
    protected static string $resource = TalkResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make()
        ];
    }
}
