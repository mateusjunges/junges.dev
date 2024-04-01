<?php

declare(strict_types=1);

namespace App\Filament\Resources\AdResource\Pages;

use App\Filament\Resources\AdResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables\Actions\DeleteAction;

final class EditAd extends EditRecord
{
    protected static string $resource = AdResource::class;
}
