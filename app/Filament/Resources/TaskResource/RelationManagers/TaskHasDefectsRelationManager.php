<?php

namespace App\Filament\Resources\TaskResource\RelationManagers;


use Filament\Tables;
use App\Models\Defect;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\RelationManagers\RelationManager;


class TaskHasDefectsRelationManager extends RelationManager
{
    protected static string $relationship = 'taskHasDefects';

    protected static ?string $recordTitleAttribute = 'restaurant_id';

    protected static ?string $label = '缺失紀錄';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('IMGAGE')
                        ->description('必須至少上傳一張照片')
                        ->schema([
                            FileUpload::make('image_0')
                                ->image()
                                ->directory('food-safety')
                                ->required(),
                            FileUpload::make('image_1')
                                ->image()
                                ->directory('food-safety'),
                        ]),
                    Wizard\Step::make('Group')
                        ->description('選擇一個符合的群組')
                        ->schema([
                            Select::make('group')
                                ->options(\App\Models\Defect::getDistinctGroups()->pluck('group', 'group'))
                                ->reactive()
                                ->required(),
                        ]),
                    Wizard\Step::make('Title')
                        ->description('選擇一個符合的標題')
                        ->schema([
                            Select::make('title')
                                ->options(function (callable $get) {
                                    $title = Defect::getDistinctTitlesByGroup($get('group'));
                                    return $title->pluck('title', 'title');
                                })
                                ->reactive()
                                ->required(),
                        ]),
                    Wizard\Step::make('Description')
                        ->description('選擇一個符合的描述')
                        ->schema([
                            Select::make('defect_id')
                                ->options(function (callable $get) {
                                    $description = Defect::getDescriptionWhereByGroupAndTitle($get('group'), $get('title'));
                                    return $description->pluck('description', 'id');
                                })
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

    // protected function canCreate(): bool
    // {
    //     dd(auth()->user()->with('task'));
    //     if (auth()->user()->task) {
    //         if (auth()->user()->task->task_date->isToday()) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }
}
