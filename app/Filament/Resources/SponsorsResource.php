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
                Forms\Components\FileUpload::make('logo_url')->required(),
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('alt_text')->required(),
                Forms\Components\TextInput::make('sponsor_tier')->required(),
                Forms\Components\DatePicker::make('started_sponsoring_at'),
                Forms\Components\DatePicker::make('stop_sponsoring_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->limit(70)->sortable(),
                Tables\Columns\TextColumn::make('started_sponsoring_at')->sortable()->date(),
                Tables\Columns\ImageColumn::make('logo_url'),
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
            'index' => ListSponsors::class,
            'edit' => EditSponsor::class,
            'create' => CreateSponsor::class
        ];
    }
}
