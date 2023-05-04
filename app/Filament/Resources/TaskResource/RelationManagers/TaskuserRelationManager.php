<?php

namespace App\Filament\Resources\TaskResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Support\Facades\Auth;

class TaskuserRelationManager extends RelationManager
{
    // Task Model 裡面的 taskUser() 關聯
    protected static string $relationship = 'taskUsers';

    protected static ?string $label = '稽核員';

    protected static ?string $recordTitleAttribute = 'is_completed';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('is_completed')
                    ->label('是否完成')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('姓名'),
                Tables\Columns\ToggleColumn::make('is_completed')
                    ->label('是否完成')
                    ->updateStateUsing(function ($record, $state) {
                        $record->is_completed = $state;
                        $record->save();
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
