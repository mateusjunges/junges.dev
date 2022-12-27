<?php declare(strict_types=1);

namespace App\Filament\Resources\Sponsors;

use App\Modules\Adverstisement\Models\Sponsor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Log;
use Livewire\TemporaryUploadedFile;

final class SponsorResource extends Resource
{
    protected static ?string $model = Sponsor::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Ads';

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('website')
                    ->url()
                    ->placeholder('The sponsor website')
                    ->required(),
                FileUpload::make('logo')
                    ->disk('sponsors')
                    ->acceptedFileTypes([
                        'image/svg+xml',
                        'image/*',
                    ])
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                        Log::info('Mime: '.$file->getMimeType());

                        return (string) str(now()->format('Y_m_d_His'))
                            ->prepend('sponsors-')
                            ->append('.'.$file->getClientOriginalExtension());
                    })
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->limit(70)->sortable(),
                TextColumn::make('website')->limit(70)->sortable(),
                ImageColumn::make('logo')->disk('public'),
                TextColumn::make('created_at')->sortable()->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSponsors::route('/'),
            'create' => Pages\CreateSponsor::route('/create'),
            'edit' => Pages\EditSponsor::route('/{record}/edit'),
        ];
    }
}
