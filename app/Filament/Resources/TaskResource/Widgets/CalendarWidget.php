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

        return [
            [
                'id' => 1,
                'title' => 'Breakfast!',
                'start' => now()
            ],
            [
                'id' => 2,
                'title' => 'Meeting with Pamela',
                'start' => now()->addDay(),
                'url' => 'https://some-url.com',
                'shouldOpenInNewTab' => true,
            ]
        ];
    }

    public function createEvent(array $data): void
    {

        Task::create([
            'category' => $data['category'],
            'restaurant_id' => $data['restaurant_id'],
            'user_id' => $data['user_id'],
            'task_date' => $data['task_date'],
        ]);
    }

    protected static function getCreateEventFormSchema(): array
    {
        $restaurants =  Restaurant::get();

        $restaurantGroupByBrand = $restaurants->groupBy('brand')->keys();

        $restaurantGroupByShop = $restaurants->groupBy('shop')->keys();

        $auditors = User::whereHas('roles', fn (Builder $query) => $query->where('name', 'auditor'))->get()->pluck('name', 'id');
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
            Select::make('brand')
                ->label('品牌')
                ->options($restaurantGroupByBrand)
                ->required(),
            Select::make('restaurant_id')
                ->label('分店')
                ->options($restaurantGroupByShop)
                ->required(),
            Select::make('user_id')
                ->label('稽核員')
                ->options($auditors)
                ->required(),
            DatePicker::make('task_date')
                ->label('稽核日期')
                ->required(),
        ];
    }
}
