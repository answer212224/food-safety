<?php

namespace App\Filament\Pages;


use Filament\Pages\Page;
use App\Filament\Resources\TaskResource\Widgets\CalendarWidget;

class Jobs extends Page
{
    protected static ?string $navigationLabel = '行事曆';

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static string $view = 'filament.pages.jobs';

    protected function getHeaderWidgets(): array
    {
        return [
            CalendarWidget::class
        ];
    }
}
