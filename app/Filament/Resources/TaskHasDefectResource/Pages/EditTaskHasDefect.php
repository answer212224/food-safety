<?php

namespace App\Filament\Resources\TaskHasDefectResource\Pages;

use App\Filament\Resources\TaskHasDefectResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTaskHasDefect extends EditRecord
{
    protected static string $resource = TaskHasDefectResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
