<?php

declare(strict_types=1);

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Modules\Blog\Models\Post;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

/** @property-read Post $record */
final class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('preview')->url($this->record->adminPreviewUrl(), shouldOpenInNewTab: true),
        ];
    }
}
