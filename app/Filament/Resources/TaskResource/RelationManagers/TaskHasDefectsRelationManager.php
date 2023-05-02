<?php

namespace App\Filament\Resources\TaskResource\RelationManagers;


use Filament\Tables;
use App\Models\Defect;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Contracts\HasRelationshipTable;
use Filament\Resources\RelationManagers\RelationManager;


class TaskHasDefectsRelationManager extends RelationManager
{
    protected static string $relationship = 'taskHasDefects';

    protected static ?string $recordTitleAttribute = 'restaurant_id';

    protected static ?string $label = '缺失';

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
                    Wizard\Step::make('Workspace')
                        ->description('選擇一個符合的區站')
                        ->schema([
                            Select::make('restaurant_workspace_id')
                                ->options(function (RelationManager $livewire): array {
                                    return $livewire->ownerRecord->restaurant->restaurantWorkspaces
                                        ->pluck('area', 'id')
                                        ->toArray();
                                }),
                        ]),
                    Wizard\Step::make('Group')
                        ->description('選擇一個符合的缺失')
                        ->schema([
                            Select::make('group')
                                ->options(\App\Models\Defect::getDistinctGroups()->pluck('group', 'group'))
                                ->reactive()
                                ->required(),
                            Select::make('title')
                                ->options(function (callable $get) {
                                    $title = Defect::getDistinctTitlesByGroup($get('group'));
                                    return $title->pluck('title', 'title');
                                })
                                ->reactive()
                                ->required(),
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
        return
            $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_0')->size(300),
                Tables\Columns\ImageColumn::make('image_1')->size(300),
                Tables\Columns\TextColumn::make('restaurantWorkspace.area')
                    ->label('區站'),
                Tables\Columns\TextColumn::make('defect.group')
                    ->label('缺失群組'),
                Tables\Columns\TextColumn::make('defect.title')
                    ->label('缺失項目'),
                Tables\Columns\TextColumn::make('defect.description')
                    ->label('缺失項目'),
            ])

            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])

            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->using(function (HasRelationshipTable $livewire, array $data): Model {
                    $livewire->ownerRecord->update([
                        'status' => '執行中',
                    ]);
                    return $livewire->getRelationship()->create($data);
                }),
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
