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

use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class TaskHasDefectsRelationManager extends RelationManager
{
    protected static string $relationship = 'taskHasDefects';

    protected static ?string $recordTitleAttribute = 'restaurant_id';

    protected static ?string $label = '缺失紀錄';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                // FileUpload::make('image_0')->image()->directory('food-safety'),
                // FileUpload::make('image_1')->image()->directory('food-safety'),
                // Select::make('defect_id')
                //     ->options(\App\Models\Defect::pluck('description', 'id')->toArray())
                //     ->required(),
                Wizard::make([
                    Wizard\Step::make('IMG')
                        ->description('必須至少上傳一張照片')
                        ->schema([
                            FileUpload::make('image_0')->image()->directory('food-safety')->required(),
                            FileUpload::make('image_1')->image()->directory('food-safety'),
                        ]),
                    Wizard\Step::make('Group')
                        ->description('必須選擇一個群組')
                        ->schema([
                            Select::make('defect_id')
                                ->options(\App\Models\Defect::pluck('description', 'id')->toArray())
                                ->required(),
                        ]),
                    Wizard\Step::make('Billing')
                        ->schema([
                            Select::make('defect_id')
                                ->options(\App\Models\Defect::pluck('description', 'id')->toArray())
                                ->required(),
                        ]),
                ])
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('defect.group')
                    ->label('缺失群組'),
                Tables\Columns\TextColumn::make('defect.title')
                    ->label('缺失項目'),
                Tables\Columns\IconColumn::make('is_improved')
                    ->boolean(),
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
