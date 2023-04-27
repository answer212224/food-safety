<?php

namespace App\Filament\Resources\TaskResource\RelationManagers;

use Filament\Forms;
use App\Models\Task;
use App\Models\User;
use Filament\Tables;
use Filament\Resources\Form;

use Filament\Resources\Table;
use App\Models\RestaurantWorkspace;

use Filament\Forms\Components\Select;

use Filament\Forms\Components\FileUpload;

use Filament\Tables\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;

class TaskHasDefectsRelationManager extends RelationManager
{
    protected static string $relationship = 'taskHasDefects';

    protected static ?string $recordTitleAttribute = 'restaurant_id';

    protected static ?string $label = '缺失紀錄';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Select::make('defect_id')
                    ->options(\App\Models\Defect::pluck('description', 'id')->toArray())
                    ->required(),
                FileUpload::make('image_0')->image()->directory('form-attachments'),
                FileUpload::make('image_1')->image()->directory('form-attachments'),
                TextInput::make('score')->fill('task.score'),
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
