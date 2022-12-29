<?php declare(strict_types=1);

namespace App\Filament\Resources\AdResource\Pages;

use App\Filament\Resources\AdResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

final class ListAds extends ListRecords
{
    protected static string $resource = AdResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
