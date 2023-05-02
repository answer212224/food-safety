<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskHasDefectResource\Pages;
use App\Filament\Resources\TaskHasDefectResource\RelationManagers;
use App\Models\TaskHasDefect;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskHasDefectResource extends Resource
{
    protected static ?string $model = TaskHasDefect::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('task_id')
                    ->required(),
                Forms\Components\TextInput::make('defect_id')
                    ->required(),
                Forms\Components\FileUpload::make('image_0')
                    ->required(),

                Forms\Components\FileUpload::make('image_1'),

                Forms\Components\Toggle::make('is_improved')
                    ->required(),
                Forms\Components\TextInput::make('group')
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('task_id'),
                Tables\Columns\TextColumn::make('defect_id'),
                Tables\Columns\ImageColumn::make('image_0'),
                Tables\Columns\ImageColumn::make('image_1'),
                Tables\Columns\IconColumn::make('is_improved')
                    ->boolean(),
                Tables\Columns\TextColumn::make('group'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTaskHasDefects::route('/'),
            'create' => Pages\CreateTaskHasDefect::route('/create'),
            // 'edit' => Pages\EditTaskHasDefect::route('/{record}/edit'),

        ];
    }
}
