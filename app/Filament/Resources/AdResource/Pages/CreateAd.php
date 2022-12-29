<?php declare(strict_types=1);

namespace App\Filament\Resources\AdResource\Pages;

use App\Filament\Resources\AdResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateAd extends CreateRecord
{
    protected static string $resource = AdResource::class;
}
