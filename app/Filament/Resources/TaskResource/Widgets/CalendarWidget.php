<?php

namespace App\Filament\Resources\TaskResource\Widgets;

use App\Models\Task;
use App\Models\User;
use App\Models\Restaurant;
use Spatie\Permission\Models\Role;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

// Your newly created widget should extends the Saade\FilamentFullCalendar\Widgets\FullCalendarWidget class of this package
class CalendarWidget extends FullCalendarWidget
{
    // Don't forget to remove protected static string $view from the generated class!
    // protected static string $view = 'filament.resources.task-resource.widgets.calendar-widget';

    public function getViewData(): array
    {
        $tasks = Task::all();

        $tasks->transform(function ($task) {
            $task->title = $task->category;
            $task->start = $task->task_date;
            return $task;
        });

        return $tasks->toArray();
    }

    public function createEvent(array $data): void
    {
        foreach ($data['user_id'] as $user_id) {
            Task::create([
                'category' => $data['category'],
                'restaurant_id' => $data['restaurant_id'],
                'user_id' => $user_id,
                'task_date' => $data['task_date'],
            ]);
        }
        $this->refreshEvents();
    }

    public function onEventClick($event): void
    {
        parent::onEventClick($event);
    }

    protected static function getCreateEventFormSchema(): array
    {
        return [
            Select::make('category')
                ->label('分類')
                ->options([
                    '食安及S5巡檢' => '食安及S5巡檢',
                    '清潔檢查' => '清潔檢查',
                    '餐點採樣' => '餐點採樣',
                    '專案查核' => '專案查核',
                ])
                ->required(),
            Select::make('restaurant_id')
                ->label('門市')
                ->options(Restaurant::all()->pluck('name', 'id'))
                ->searchable()
                ->required(),
            Select::make('user_id')
                ->label('稽核員')
                ->multiple()
                ->options(User::whereHas('roles', fn (Builder $query) => $query->where('name', 'auditor'))->get()->pluck('name', 'id'))
                ->required(),
            DatePicker::make('task_date')
                ->label('稽核日期')
                ->required(),
        ];
    }

    // protected static function getEditEventFormSchema(): array
    // {
    //     return [
    //         Forms\Components\TextInput::make('title')
    //             ->required(),
    //         Forms\Components\DatePicker::make('start')
    //             ->required(),
    //         Forms\Components\DatePicker::make('end')
    //             ->default(null),
    //     ];
    // }

    public static function canCreate(): bool
    {
        if (auth()->user()->hasPermissionTo('create: tasks')) {
            return true;
        }
        return false;
    }

    public static function canEdit(?array $event = null): bool
    {
        if (auth()->user()->hasPermissionTo('update: tasks')) {
            return true;
        }
        return false;
    }
}
