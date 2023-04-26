<?php

namespace App\Filament\Resources\DefectResource\Pages;

use App\Filament\Resources\DefectResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDefect extends EditRecord
{
    protected static string $resource = DefectResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
