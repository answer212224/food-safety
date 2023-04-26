<?php

namespace App\Filament\Resources\TaskResource\RelationManagers;

use App\Models\Defect;
use App\Models\Task;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;


class TaskHasDefectsRelationManager extends RelationManager
{
    protected static string $relationship = 'taskHasDefects';

    protected static ?string $recordTitleAttribute = 'defect_id';



    public static function form(Form $form): Form
    {
        $record = request()->route()->parameter('record');

        $task = Task::find($record)->load('restaurant.restaurant_workspaces');

        return $form
            ->schema([
                Select::make('restaurant_workspace_id')
                    ->options($task->restaurant->restaurant_workspaces->pluck('area', 'id'))
                    ->required(),
                // Select::make('defect_id')
                //     ->options(Defect::pluck('category', 'id'))
                //     ->preload()
                //     ->required(),

                FileUpload::make('images')->image()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('defect.category'),
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
}
