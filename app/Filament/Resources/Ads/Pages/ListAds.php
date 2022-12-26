<?php declare(strict_types=1);

namespace App\Filament\Resources\Ads\Pages;

use App\Filament\Resources\Ads\AdsResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListAds extends ListRecords
{
    protected static string $resource = AdsResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
