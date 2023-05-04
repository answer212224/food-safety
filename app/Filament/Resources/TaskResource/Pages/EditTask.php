<?php

namespace App\Filament\Resources\TaskResource\Pages;

use Filament\Pages\Actions;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\TaskResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditTask extends EditRecord
{
    protected static string $resource = TaskResource::class;

    // resources\views\filament\resources\task-resource\pages\task-has-defect-process.blade.php

    protected static string $view = 'filament.resources.task-resource.pages.task-has-defect-process';

    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function beforeSave(): void
    {
        $taskUsers = $this->record->taskUsers;
        $isAllCompleted = $taskUsers->every(function ($taskUser) {
            return $taskUser->is_completed == true;
        });

        if (!$isAllCompleted) {
            Notification::make()
                ->warning()
                ->title('稽核員尚未完成稽核')
                ->body('請確認是否所有人員皆完成稽核')
                ->persistent()
                ->send();
            $this->halt();
        }
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $data = array_merge($data, ['status' => "處理完畢"]);
        $record->update($data);
        return $record;
    }
}
