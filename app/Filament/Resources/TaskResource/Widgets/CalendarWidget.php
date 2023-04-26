<?php

namespace App\Filament\Resources\TaskResource\Widgets;

use App\Models\Task;
use Filament\Widgets\Widget;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

// Your newly created widget should extends the Saade\FilamentFullCalendar\Widgets\FullCalendarWidget class of this package
class CalendarWidget extends FullCalendarWidget
{
    // Don't forget to remove protected static string $view from the generated class!
    // protected static string $view = 'filament.resources.task-resource.widgets.calendar-widget';

    public function getViewData(): array
    {
        $tasks = Task::all();
        // dump($tasks);
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

    /**
     * FullCalendar will call this function whenever it needs new event data.
     * This is triggered when the user clicks prev/next or switches views on the calendar.
     */
    public function fetchEvents(array $fetchInfo): array
    {
        // You can use $fetchInfo to filter events by date.
        return [];
    }

    /**
     * Triggered when the user clicks an event.
     */
    public function onEventClick($event): void
    {
        parent::onEventClick($event);

        // your code
    }

    /**
     * Triggered when dragging stops and the event has moved to a different day/time.
     */
    public function onEventDrop($newEvent, $oldEvent, $relatedEvents): void
    {
        // your code
    }

    /**
     * Triggered when event's resize stops.
     */
    public function onEventResize($event, $oldEvent, $relatedEvents): void
    {
        // your code
    }
}
