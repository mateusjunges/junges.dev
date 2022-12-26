<?php declare(strict_types=1);

namespace App\Filament\Resources\Ads\Pages;

use App\Filament\Resources\Ads\AdsResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateAd extends CreateRecord
{
    protected static string $resource = AdsResource::class;

}
