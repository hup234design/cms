<?php

namespace Hup234design\Cms\Filament\Resources;

use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Carbon\Carbon;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\Cms\Filament\Resources\EventResource\Pages;
use Hup234design\Cms\Filament\Resources\EventResource\RelationManagers;
use Hup234design\Cms\Filament\Support\FormComponents;
use Hup234design\Cms\Models\Event;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TitleWithSlugInput::make(
                    fieldTitle: 'title', // The name of the field in your model that stores the title.
                    fieldSlug: 'slug', // The name of the field in your model that will store the slug.
                    urlPath: '/events/',
                ),
                Forms\Components\Select::make('event_category_id')
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
                Forms\Components\Textarea::make('summary')
                    ->rows(3)
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->default(Carbon::now())
                    ->required(),
                Forms\Components\TimePicker::make('start_time')
                    ->withoutSeconds()
                    ->default(Carbon::now()->format('H:i')),
                Forms\Components\TimePicker::make('end_time')
                    ->withoutSeconds()
                    ->default(Carbon::now()->addHours(4)->format('H:i')),
                Forms\Components\Toggle::make('published')
                    ->default(false),
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
                    ->label('ID')
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('category.title'),
                Tables\Columns\ToggleColumn::make('published'),
                Tables\Columns\TextColumn::make('date')
                    ->date(),
                Tables\Columns\TextColumn::make('start_time')
                    ->time('H:i'),
                Tables\Columns\TextColumn::make('end_time')
                    ->time('H:i'),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
