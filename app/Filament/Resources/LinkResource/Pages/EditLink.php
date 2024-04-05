<?php

declare(strict_types=1);

namespace App\Filament\Resources\LinkResource\Pages;

use App\Filament\Resources\LinkResource;
use App\Modules\Blog\Actions\ApproveLinkAction;
use App\Modules\Blog\Actions\CreatePostFromLinkAction;
use App\Modules\Blog\Actions\RejectLinkAction;
use App\Modules\Blog\Models\Link;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions;

/** @property-read Link $record */
final class EditLink extends EditRecord
{
    protected static string $resource = LinkResource::class;

    protected function getActions(): array
    {
        $actions = [DeleteAction::make()];

        if ($this->record->status === Link::STATUS_SUBMITTED) {
            $actions = array_merge([
                Actions\Action::make('Approve and create post')
                    ->color('primary')
                    ->requiresConfirmation()
                    ->action(function (ApproveLinkAction $approveLink, CreatePostFromLinkAction $createPostFromLink) {
                        $approveLink->execute($this->record);
                        $createPostFromLink->execute($this->record);

                        Notification::make()
                            ->title('The link was approved.')
                            ->success()
                            ->send();

                        $this->data['status'] = $this->record->status;
                    }),
                Actions\Action::make('Approve')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (ApproveLinkAction $approveLink) {
                        $approveLink->execute($this->record);

                        Notification::make()
                            ->title('The link was approved.')
                            ->success()
                            ->send();

                        $this->data['status'] = $this->record->status;
                    }),
                Actions\Action::make('Reject')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->action(function (RejectLinkAction $rejectLink) {
                        $rejectLink->execute($this->record);

                        Notification::make()
                            ->title('The link was rejected.')
                            ->success()
                            ->send();

                        $this->data['status'] = $this->record->status;
                    }),
            ], $actions);
        }

        return $actions;
    }
}
