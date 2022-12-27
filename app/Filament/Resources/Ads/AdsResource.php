<?php declare(strict_types=1);

namespace App\Filament\Resources\Ads;

use App\Modules\Adverstisement\Models\Ad;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;

final class AdsResource extends Resource
{
    protected static ?string $model = Ad::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Ads';

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                MarkdownEditor::make('text')->required(),
                TextInput::make('display_on_url'),
                DatePicker::make('starts_at'),
                DatePicker::make('ends_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('text')->limit(70)->sortable(),
                TextColumn::make('starts_at')->sortable()->date(),
                TextColumn::make('ends_at')->sortable()->date(),

            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->defaultSort('starts_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAds::route('/'),
            'create' => Pages\CreateAd::route('/create'),
            'edit' => Pages\EditAd::route('/{record}/edit'),
        ];
    }
}
