<?php

namespace Hup234design\Cms\Filament\Resources;

use Hup234design\Cms\Filament\Resources\EnquiryResource\Pages;
use Hup234design\Cms\Filament\Resources\EnquiryResource\RelationManagers;
use Hup234design\Cms\Models\Enquiry;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Hup234design\Cms\Models\EnquiryBlock;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnquiryResource extends Resource
{
    protected static ?string $model = Enquiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    protected static ?string $navigationGroup = 'Enquiries';

    protected static ?int $navigationSort = 1;

    protected static function shouldRegisterNavigation(): bool
    {
        return cms_settings('enquiries_enabled');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name'),
                Forms\Components\TextInput::make('last_name'),
                Forms\Components\TextInput::make('email'),
                Forms\Components\TextInput::make('telephone'),
                Forms\Components\TextInput::make('subject')->columnSpan(2),
                Forms\Components\Textarea::make('message')->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')->label('Received')->dateTime(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('telephone'),
                Tables\Columns\TextColumn::make('subject'),
                Tables\Columns\TextColumn::make('ip_address')->toggleable()->toggledHiddenByDefault(true),
                Tables\Columns\IconColumn::make('spam')->boolean(),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->label('Received')
                    ->form([
                        Forms\Components\DatePicker::make('received_after'),
                        Forms\Components\DatePicker::make('received_before'),
                    ])
                    ->columns(2)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['received_after'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['received_before'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->columnSpan(2),
                Tables\Filters\TernaryFilter::make('spam')
                    ->placeholder('Without SPAM')
                    ->trueLabel('With SPAM')
                    ->falseLabel('Only SPAM')
                    ->queries(
                        true: fn (Builder $query) => $query,
                        false: fn (Builder $query) => $query->spam(),
                        blank: fn (Builder $query) => $query->notSpam(),
                    )
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->slideOver(),
                Tables\Actions\DeleteAction::make(),
//                Tables\Actions\Action::make('markSpam')
//                    ->label('Spam')
//                    ->icon('heroicon-o-shield-exclamation')
//                    ->action(function (Model $record, array $data): void {
//                        if ($data['is_spam']) {
//                            EnquiryBlock::firstOrCreate(['type' => 'email', 'value' => $record->email]);
//                            $record->update(['spam' => true]);
//                        }
//                        if ($data['block_ip_address']) {
//                            EnquiryBlock::firstOrCreate(['type' => 'ip_address', 'value' => $record->ip_address]);
//                        }
//                        if ($data['block_domain']) {
//                            EnquiryBlock::firstOrCreate(['type' => 'domain', 'value' => $record->domain]);
//                        }
//                    })
//                    ->modalHeading(fn(Model $record) => $record->first_name . " " . $record->last_name . " ( ".$record->email." )" )
//                    ->modalSubheading(fn(Model $record) => $record->created_at . " ( ".$record->ip_address." )" )
//                    ->form([
//                        Forms\Components\Toggle::make('is_spam')->label('Mark as Spam'),
//                        Forms\Components\Toggle::make('block_ip_address')->label(fn(Model $record) => 'Block this IP Address ( ' . $record->ip_address . ' )' ),
//                        Forms\Components\Toggle::make('block_domain')->label(fn(Model $record) => 'Block this Domain ( ' . $record->domain . ' )' ),
//                    ])
//                    ->hidden(fn(Model $record) => $record->spam),
//                Tables\Actions\Action::make('clearSpam')
//                    ->label('Spam')
//                    ->icon('heroicon-o-shield-exclamation')
//                    ->modalHeading(fn(Model $record) => $record->first_name . " " . $record->last_name . " ( ".$record->email." )" )
//                    ->modalSubheading(fn(Model $record) => $record->created_at . " ( ".$record->ip_address." )" )
//                    ->action(function (Model $record, array $data): void {
//                        if ($data['not_spam']) {
//                            EnquiryBlock::where('type','email')->where('value', $record->email)->delete();
//                            $record->update(['spam' => false]);
//                        }
//                        if ($data['allow_ip_address']) {
//                            EnquiryBlock::where('type','ip_address')->where('value', $record->ip_address)->delete();
//                        }
//                        if ($data['allow_domain']) {
//                            EnquiryBlock::where('type','domain')->where('value', $record->domain)->delete();
//                        }
//                    })
//                    ->form([
//                        Forms\Components\Toggle::make('not_spam')->label('Mark as NOT Spam'),
//                        Forms\Components\Toggle::make('allow_ip_address')->label(fn(Model $record) => 'Remove this IP Address  from block list ( ' . $record->ip_address . ' )' ),
//                        Forms\Components\Toggle::make('allow_domain')->label(fn(Model $record) => 'Remove this Domain  from block list ( ' . $record->domain . ' )' ),
//                    ])
//                    ->hidden(fn(Model $record) => ! $record->spam)
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
            'index' => Pages\ListEnquiries::route('/'),
            //'view' => Pages\ViewEnquiry::route('/{record}'),
            //'edit' => Pages\EditEnquiry::route('/{record}/edit'),
        ];
    }
}
