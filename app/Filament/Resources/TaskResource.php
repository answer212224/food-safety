<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Task;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers\TaskHasDefectsRelationManager;
use Filament\Forms\Components\Select;

class TaskResource extends Resource
{
    protected static ?string $label = '稽核任務';

    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('inner_manager')
                        ->label('內場主管')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('outer_manager')
                        ->label('外場主管')
                        ->required()
                        ->maxLength(255),
                    Select::make('status')
                        ->label('狀態')
                        ->options(
                            [
                                '處理完畢' => '處理完畢',
                                '未處理' => '未處理'
                            ]
                        )
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('ID'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('稽查員'),
                Tables\Columns\TextColumn::make('category')
                    ->label('分類'),
                Tables\Columns\TextColumn::make('restaurant.name')
                    ->label('門市'),
                Tables\Columns\TextColumn::make('task_date')
                    ->label('稽查日期')
                    ->date(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('狀態')
                    ->colors([
                        'primary',
                        'danger' => '未處理',
                        'warning' => '處理中',
                        'success' => '處理完畢',
                    ]),
                Tables\Columns\TextColumn::make('inner_manager')
                    ->label('內場主管'),
                Tables\Columns\TextColumn::make('outer_manager')
                    ->label('外場主管'),

            ])
            ->filters([
                SelectFilter::make('user')->relationship('user', 'name')->default(auth()->user()->id),
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
            TaskHasDefectsRelationManager::class,
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
