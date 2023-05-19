<?php

namespace Hup234design\Cms\Filament\Resources;

use Hup234design\Cms\Filament\Resources\SocialNetworkResource\Pages;
use Hup234design\Cms\Models\SocialNetwork;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SocialNetworkResource extends Resource
{
    protected static ?string $model = SocialNetwork::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('name')
                    ->options([
                        'facebook' => 'Facebook',
//                        'instagram' => 'Instagram',
//                        'linkedin' => 'LinkedIn',
//                        'pinterest' => 'Pinterest',
//                        'tiktok' => 'TikTok',
                        'twitter' => 'Twitter',
//                        'vimeo' => 'Vimeo',
//                        'whatsapp' => 'WhatsApp',
//                        'youtube' => 'Youtube',
                    ])
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(function ($set, ?string $state) {
                        $set('url', 'https://www.' . $state . '.com/');
                    })
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->inline(false)
                    ->default(true),
                Forms\Components\TextInput::make('url')
                    ->label('Enter your username or channel identifier
                            (depends on rule of the selected social network)')
                    ->url()
                    ->columnSpan(2),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('url'),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
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
            'index' => Pages\ListSocialNetworks::route('/'),
        ];
    }
}
