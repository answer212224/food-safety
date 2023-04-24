<?php

namespace App\Filament\Pages;

use Carbon\Carbon;
use Filament\Pages\Page;
use Buildix\Timex\Pages\Timex;
use Buildix\Timex\Events\EventItem;

class Calendars extends Timex
{
    public static function getEvents(): array
    {
        $events = self::getModel()::orderBy('startTime')->get()
            ->map(function ($event) {
                return EventItem::make($event->id)
                    ->body($event->body)
                    ->category($event->category)
                    ->color($event->category)
                    ->end(Carbon::create($event->end))
                    ->isAllDay($event->isAllDay)
                    ->subject($event->subject)
                    ->organizer($event->organizer)
                    ->participants($event?->participants)
                    ->start(Carbon::create($event->start))
                    ->startTime($event?->startTime);
            })->toArray();
        return $events;
    }
}
