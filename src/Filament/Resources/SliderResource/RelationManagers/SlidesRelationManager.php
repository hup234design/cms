<?php

namespace Hup234design\Cms\Filament\Resources\SliderResource\RelationManagers;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SlidesRelationManager extends RelationManager
{
    protected static string $relationship = 'slides';

    protected static ?string $recordTitleAttribute = 'heading';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('heading')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('subheading')
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\Textarea::make('text')
                    ->nullable()
                    ->rows(3)
                    ->columnSpanFull(),
                CuratorPicker::make('image_id')
                    ->helperText('PLease select a single image. There is an open issue with the image picker that allows multiple selctions. If more than one image is selected, only the first image will be used. For multiple please use gallery block.')
                    ->multiple(false)
                    ->label('Image')
                    //->buttonLabel('buttonLabel')
                    ->size('lg')
                    ->constrained(true)
                    ->preserveFilenames()
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('heading'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    protected function getTableReorderColumn(): ?string
    {
        return 'sort_order';
    }
}
