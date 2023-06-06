<?php

namespace Hup234design\Cms\Filament\Resources;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Carbon\Carbon;
use Filament\Forms\Components\Placeholder;
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
use Illuminate\Support\HtmlString;
use RalphJSmit\Filament\Components\Forms\Sidebar;
use RalphJSmit\Filament\Components\Forms\Timestamps;
use RalphJSmit\Filament\SEO\SEO;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Event Management';

    protected static ?int $navigationSort = 1;

    protected static function shouldRegisterNavigation(): bool
    {
        return cms_settings('events_enabled', false);
    }

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
                ])
                ->collapsible()
                ->collapsed(false),
            Forms\Components\Section::make('Featured Image')
                ->schema([
                    Placeholder::make('Note')
                        ->label(false)
                        ->content(new HtmlString('<span class="text-sm italic">Please select a single image. There is an open issue with the image picker that allows multiple selctions. If more than one image is selected, only the first image will be used. For multiple please use gallery block.</span>')),
                    CuratorPicker::make('featured_image_id')
                        ->label(false)
                        ->multiple(false)
                        ->buttonLabel('Select Image')
                        ->size('md')
                        ->constrained(true)
                        ->preserveFilenames()
                        ->reactive(),
                ])
                ->collapsible()
                ->collapsed(false),
            Forms\Components\Section::make('SEO')
                ->schema([
                    SEO::make(),
                    Placeholder::make('Note')
                        ->label(false)
                        ->content(new HtmlString('<span class="text-sm italic">Please select a single image. There is an open issue with the image picker that allows multiple selctions. If more than one image is selected, only the first image will be used. For multiple please use gallery block.</span>')),
                    CuratorPicker::make('seo_image_id')
                        ->label(false)
                        ->multiple(false)
                        ->buttonLabel('Select Image')
                        ->size('md')
                        ->constrained(true)
                        ->preserveFilenames()
                        ->reactive(),
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
