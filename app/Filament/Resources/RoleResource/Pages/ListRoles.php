<?php

namespace App\Filament\Resources\RoleResource\Pages;

use Filament\Pages\Actions;
use App\Filament\Resources\RoleResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\RoleResource\Widgets\CalendarWidget;

class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            CalendarWidget::class,
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
