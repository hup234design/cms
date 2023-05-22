<?php

namespace Hup234design\Cms\Filament\Resources;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Hup234design\Cms\Filament\Resources\GalleryResource\Pages;
use Hup234design\Cms\Filament\Resources\GalleryResource\RelationManagers;
use Hup234design\Cms\Models\Gallery;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->rows(3),
                Forms\Components\Repeater::make('images')
                    ->schema([
                        CuratorPicker::make('image_id')
                            ->label('Image')
                            ->buttonLabel('Select Image')
                            ->size('sm')
                            ->preserveFilenames()
                            ->required(),
                    ])
                    ->grid(3)
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('images')
                    ->getStateUsing(function (Gallery $record): float {
                        return count($record->images);
                    }),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->since(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver(),
                Tables\Actions\DeleteAction::make()
                    ->slideOver(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListGalleries::route('/'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
