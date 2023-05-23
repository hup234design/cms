<?php

namespace Hup234design\Cms\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Hup234design\Cms\Models\Download;
use Illuminate\Support\Str;

class DownloadResource extends Resource
{
    protected static ?string $model = Download::class;

    //protected static ?string $navigationGroup = 'Content Management';

    //protected static ?int $navigationSort = 6;

    protected static ?string $navigationIcon = 'heroicon-o-download';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->lazy()
                    ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->lazy()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)) )
                    ->unique(self::getModel(), 'slug', ignoreRecord: true),
                Forms\Components\Textarea::make('description')
                    ->nullable()
                    ->columnSpan(2),
                Forms\Components\FileUpload::make('file_name')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                    ])
                    ->required()
                    ->storeFileNamesIn('original_file_name')
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('original_file_name')
                    ->searchable()
                    ->label('File')
                    ->icon('heroicon-o-document'),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated')->since(),
                Tables\Columns\TextColumn::make('created_at')->label('Created')->datetime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->slideOver(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \Hup234design\Cms\Filament\Resources\DownloadResource\Pages\ListDownloads::route('/'),
        ];
    }
}
