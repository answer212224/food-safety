<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Task;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TaskResource\Pages;
use Filament\Resources\RelationManagers\RelationGroup;
use App\Filament\Resources\TaskResource\RelationManagers\TaskuserRelationManager;
use App\Filament\Resources\TaskResource\RelationManagers\TaskHasDefectsRelationManager;


class TaskResource extends Resource
{
    protected static ?string $label = '稽核任務';

    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Grid::make(3)
                        ->schema([
                            Forms\Components\TextInput::make('category')
                                ->label('稽核分類')
                                ->disabled(),
                            DatePicker::make('task_date')
                                ->label('稽核日期')
                                ->disabled(),
                            Select::make('restaurant_id')
                                ->label('稽核品牌')
                                ->disabled()
                                ->relationship('restaurant', 'brand'),
                            Select::make('restaurant_id')
                                ->label('稽核分店')
                                ->disabled()
                                ->relationship('restaurant', 'shop'),
                            Forms\Components\TextInput::make('inner_manager')
                                ->label('內場主管')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('outer_manager')
                                ->label('外場主管')
                                ->required()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('total')
                                ->label('總分')
                                ->disabled(),
                        ])
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('ID'),
                Tables\Columns\TextColumn::make('category')
                    ->label('分類'),
                Tables\Columns\TextColumn::make('restaurant.brand')
                    ->label('品牌'),
                Tables\Columns\TextColumn::make('restaurant.shop')
                    ->label('分店'),
                Tables\Columns\TextColumn::make('task_date')
                    ->label('稽查日期')
                    ->date(),
                Tables\Columns\TextColumn::make('total')
                    ->label('目前總分'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('狀態')
                    ->colors([
                        'primary',
                        'danger' => '未處理',
                        'warning' => '處理中',
                        'success' => '處理完畢',
                    ]),
                Tables\Columns\TagsColumn::make('users.name')
                    ->label('稽核員'),

            ])
            ->filters([
                SelectFilter::make('users')->relationship('users', 'name')->default(auth()->user()->id),
                Filter::make('task_date')
                    ->default(now())
                    ->form([
                        Forms\Components\DatePicker::make('date')
                            ->default(today())
                            ->label('稽查日期'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['date'],
                                fn (Builder $query, $date): Builder => $query->whereDate('task_date', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }


    public static function getRelations(): array
    {

        return [
            RelationGroup::make('任務相關', [
                TaskHasDefectsRelationManager::class,
                TaskuserRelationManager::class,
            ]),

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
