<?php

namespace App\Filament\Resources;

use Buildix\Timex\Resources\EventResource;
use App\Filament\Resources\TaskResource\Pages\ListTasks;
use Buildix\Timex\Resources\EventResource\Pages\EditEvent;
use Buildix\Timex\Resources\EventResource\Pages\CreateEvent;

class TaskResource extends EventResource
{

    public static function getPages(): array
    {
        return [
            'index' => ListTasks::route('/'),
            'create' => CreateEvent::route('/create'),
            'edit' => EditEvent::route('/{record}/edit'),
        ];
    }
}
