<?php declare(strict_types=1);

namespace App\Filament\Resources\SponsorsResource;

use App\Filament\Resources\SponsorsResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListSponsors extends ListRecords
{
    protected static string $resource = SponsorsResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
