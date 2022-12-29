<?php declare(strict_types=1);

namespace App\Filament\Resources\LinkResource\Pages;

use App\Filament\Resources\LinkResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateLink extends CreateRecord
{
    protected static string $resource = LinkResource::class;
}
