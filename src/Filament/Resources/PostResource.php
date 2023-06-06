<?php

namespace Hup234design\Cms\Filament\Resources;

use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Carbon\Carbon;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\Cms\Filament\Resources\PostResource\Pages;
use Hup234design\Cms\Filament\Resources\PostResource\RelationManagers;
use Hup234design\Cms\Filament\Support\FormComponents;
use Hup234design\Cms\Models\Post;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use RalphJSmit\Filament\Components\Forms\Sidebar;
use RalphJSmit\Filament\Components\Forms\Timestamps;
use RalphJSmit\Filament\SEO\SEO;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Post Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return Sidebar::make($form)->schema([
            Forms\Components\Textarea::make('summary')
                ->rows(3)
                ->required()
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
                        urlPath: '/posts/',
                    ),
                    Forms\Components\Select::make('post_category_id')
                        ->label('Category')
                        ->relationship('category','title')
                        ->nullable()
                        ->createOptionForm([
                            TitleWithSlugInput::make(
                                fieldTitle: 'title', // The name of the field in your model that stores the title.
                                fieldSlug: 'slug', // The name of the field in your model that will store the slug.
                                urlVisitLinkVisible: false,
                            ),
                            Forms\Components\Textarea::make('description')
                                ->rows(5),
                        ]),
                    Forms\Components\DateTimePicker::make('publish_at')
                        ->default(Carbon::now())
                        ->required(),
                    Forms\Components\Toggle::make('published')
                        ->default(false),
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
                    ->label('ID')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('category.title'),
                Tables\Columns\ToggleColumn::make('published'),
                Tables\Columns\TextColumn::make('publish_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
