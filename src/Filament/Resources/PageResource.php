<?php

namespace Hup234design\Cms\Filament\Resources;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\Cms\Filament\Resources\PageResource\Pages;
use Hup234design\Cms\Filament\Resources\PageResource\RelationManagers;
use Hup234design\Cms\Filament\Support\FormComponents;
use Hup234design\Cms\Models\Page;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Hup234design\Cms\Models\Slider;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use RalphJSmit\Filament\Components\Forms\Sidebar;
use RalphJSmit\Filament\Components\Forms\Timestamps;
use RalphJSmit\Filament\SEO\SEO;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Page Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return Sidebar::make($form)->schema([
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
                ->maxContentWidth('full')
                ->columnSpanFull(),
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
                    TitleWithSlugInput::make(
                        fieldTitle: 'title', // The name of the field in your model that stores the title.
                        fieldSlug: 'slug', // The name of the field in your model that will store the slug.
                        urlHostVisible: false,
                        titleLabel: 'Title',
                        titlePlaceholder: '',
                    ),
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
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug'),
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
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
