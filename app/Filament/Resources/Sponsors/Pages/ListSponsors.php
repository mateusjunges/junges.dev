<?php declare(strict_types=1);

namespace App\Filament\Resources\Sponsors\Pages;

use App\Filament\Resources\Sponsors\SponsorResource;
use Filament\Resources\Pages\ListRecords;

final class ListSponsors extends ListRecords
{
    protected static string $resource = SponsorResource::class;
}
