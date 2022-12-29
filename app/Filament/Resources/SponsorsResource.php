<?php declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SponsorsResource\CreateSponsor;
use App\Filament\Resources\SponsorsResource\EditSponsor;
use App\Filament\Resources\SponsorsResource\ListSponsors;
use Filament\Resources\Form;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Livewire\TemporaryUploadedFile;

final class SponsorsResource extends Resource
{
    public static ?string $model = \App\Modules\Advertising\Models\Sponsor::class;

    protected static ?string $navigationGroup = 'Advertising';

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\FileUpload::make('logo_url')
                    ->label('Logo')
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                        return (string) str(now()->format('Y-m-d_His'))
                            ->prepend('sponsor--')
                            ->append('.')
                            ->append($file->getClientOriginalExtension());
                    })
                    ->acceptedFileTypes(['image/*'])
                    ->disk('sponsors')
                    ->helperText('The logo to be displayed on "sponsors" section')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->helperText('The name of the sponsor.')
                    ->required(),
                Forms\Components\TextInput::make('Website')
                    ->helperText('The sponsor website')
                    ->required(),
                Forms\Components\TextInput::make('alt_text')
                    ->required()
                    ->helperText('This is the text that will be used as ALT text for this sponsor logo.'),
                Forms\Components\TextInput::make('sponsor_tier')
                    ->placeholder('$50')
                    ->helperText('The tier of the sponsor. For example: "$50", "$100", "$250"')
                    ->required(),
                Forms\Components\DatePicker::make('started_sponsoring_at')
                    ->required()
                    ->helperText('The date when this sponsor started sponsoring.'),
                Forms\Components\DatePicker::make('stop_sponsoring_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->limit(70)->sortable(),
                Tables\Columns\TextColumn::make('website')->sortable(),
                Tables\Columns\TextColumn::make('started_sponsoring_at')->sortable()->date(),
                Tables\Columns\ImageColumn::make('logo_url')->disk('sponsors'),
                Tables\Columns\TextColumn::make('alt_text'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('started_sponsoring_at', 'desc');
    }
    public static function getPages(): array
    {
        return [
            'index' => ListSponsors::route('/'),
            'create' => CreateSponsor::route('/create'),
            'edit' => EditSponsor::route('/{record}/edit'),
        ];
    }
}
