<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTask extends EditRecord
{
    protected static string $resource = TaskResource::class;

    // resources\views\filament\resources\task-resource\pages\task-has-defect-process.blade.php

    protected static string $view = 'filament.resources.task-resource.pages.task-has-defect-process';


    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
