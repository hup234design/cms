<?php

namespace Hup234design\Cms\Filament\Resources;

use Closure;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\Cms\Filament\Resources\IndexPageResource\Pages;
use Hup234design\Cms\Filament\Resources\IndexPageResource\RelationManagers;
use Hup234design\Cms\Filament\Support\FormComponents;
use Hup234design\Cms\Models\IndexPage;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use RalphJSmit\Filament\Components\Forms\Sidebar;
use RalphJSmit\Filament\Components\Forms\Timestamps;
use RalphJSmit\Filament\SEO\SEO;

class IndexPageResource extends Resource
{
    protected static ?string $model = IndexPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Page Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {

        return Sidebar::make($form)->schema([
            Forms\Components\Section::make('Header')
                ->schema([
                    Forms\Components\Select::make('slider_id')
                        ->nullable()
                        ->relationship('slider','title')
                        ->reactive(),
                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\TextInput::make('heading_title')
                                ->nullable(),
                        ])
                        ->hidden(fn (Closure $get) => $get('slider_id')),
//                    Forms\Components\Builder::make('header_blocks')
//                        ->blocks(
//                            FormComponents::headerBlocks()
//                        )
//                        ->collapsible()
                ])
                ->collapsible()
                ->collapsed(true),
            Forms\Components\Section::make('Content')
                ->schema([
                    Forms\Components\Builder::make('content_blocks')
                        ->label(false)
                        ->blocks(
                            FormComponents::contentBlocks()
                        )
                        ->createItemButtonLabel('Add Content Block')
                        ->collapsible()
                ])
                ->collapsible()
                ->collapsed(false)
        ], [
            Forms\Components\Section::make('General')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required(),
                    ...Timestamps::make(),
                ])
                ->collapsible()
                ->collapsed(false),
            Forms\Components\Section::make('SEO')
                ->schema([
                    SEO::make()
                ])
                ->collapsible()
                ->collapsed(true)
        ]);

//        return $form
//            ->schema([
//                Forms\Components\TextInput::make('title')
//                    ->required(),
//                Forms\Components\Section::make('Header')
//                    ->schema([
//                        Forms\Components\Builder::make('header_blocks')
//                            ->blocks(
//                                FormComponents::headerBlocks()
//                            )
//                            ->collapsible()
//                    ])
//                    ->collapsible()
//                    ->collapsed(true),
//                TiptapEditor::make('content')
//                    ->profile('custom')
//                    ->maxContentWidth('full'),
//                Forms\Components\Builder::make('content_blocks')
//                    ->blocks(
//                        FormComponents::contentBlocks()
//                    )
//                    ->collapsible()
//            ])
//            ->columns(1);
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
