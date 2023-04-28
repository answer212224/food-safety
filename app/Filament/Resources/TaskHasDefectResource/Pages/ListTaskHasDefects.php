<?php

namespace App\Filament\Resources\TaskHasDefectResource\Pages;

use App\Filament\Resources\TaskHasDefectResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTaskHasDefects extends ListRecords
{
    protected static string $resource = TaskHasDefectResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
