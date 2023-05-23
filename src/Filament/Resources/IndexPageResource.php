<?php

namespace Hup234design\Cms\Filament\Resources;

use FilamentTiptapEditor\TiptapEditor;
use Hup234design\Cms\Filament\Resources\IndexPageResource\Pages;
use Hup234design\Cms\Filament\Resources\IndexPageResource\RelationManagers;
use Hup234design\Cms\Filament\Support\FormComponents;
use Hup234design\Cms\Models\Page;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class IndexPageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\Section::make('Header')
                    ->schema([
                        Forms\Components\Builder::make('header_blocks')
                            ->blocks(
                                FormComponents::headerBlocks()
                            )
                            ->collapsible()
                    ])
                    ->collapsible()
                    ->collapsed(true),
                TiptapEditor::make('content')
                    ->profile('custom')
                    ->maxContentWidth('full'),
                Forms\Components\Builder::make('content_blocks')
                    ->blocks(
                        FormComponents::contentBlocks()
                    )
                    ->collapsible()
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID'),
                Tables\Columns\BadgeColumn::make('for')
                    ->label(false),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->since(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ])
            ->defaultSort('sort_order', 'asc');
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
            'index' => Pages\ListIndexPages::route('/'),
            'edit' => Pages\EditIndexPage::route('/{record}/edit'),
        ];
    }
}
