<?php

namespace App\Filament\Resources\TaskResource\Pages;

use Filament\Pages\Actions;
use App\Filament\Resources\TaskResource;
use Filament\Resources\Pages\ListRecords;


class ListTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;


    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
