<?php

namespace Hup234design\Cms\Filament\Resources;

use Hup234design\Cms\Filament\Resources\EnquiryBlockResource\Pages;
use Hup234design\Cms\Filament\Resources\EnquiryBlockResource\RelationManagers;
use Hup234design\Cms\Models\EnquiryBlock;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnquiryBlockResource extends Resource
{
    protected static ?string $model = EnquiryBlock::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-exclamation';

    protected static ?string $navigationGroup = 'Enquiries';

    protected static ?int $navigationSort = 2;

    protected static function shouldRegisterNavigation(): bool
    {
        return cms_settings('enquiries_enabled');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\BadgeColumn::make('type'),
                Tables\Columns\TextColumn::make('value'),
                Tables\Columns\TextColumn::make('enquiries')
                    ->getStateUsing(function (Model $record): float {
                        return $record->enquiries($record->type, $record->value)->count();
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Added')->since(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                ->options([
                    'ip_address' => 'IP Address',
                    'email' => 'Email Address',
                    'domain' => 'Email Domain',
                ])
                ->multiple()
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListEnquiryBlocks::route('/'),
            //'create' => Pages\CreateEnquiryBlock::route('/create'),
            //'edit' => Pages\EditEnquiryBlock::route('/{record}/edit'),
        ];
    }
}
