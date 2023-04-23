<?php

namespace App\Providers;

use App\Filament\Resources\PermissionResource;
use App\Filament\Resources\RoleResource;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register a user menu item.
        // Filament::serving(function () {
        //     if (auth()->check() && auth()->user()->hasRole(['super-admin'])) {
        //         Filament::registerUserMenuItems([
        //             UserMenuItem::make()
        //                 ->label('角色管理')
        //                 ->url(RoleResource::getUrl())
        //                 ->icon('heroicon-o-user-group'),
        //             UserMenuItem::make()
        //                 ->label('權限管理')
        //                 ->url(PermissionResource::getUrl())
        //                 ->icon('heroicon-o-shield-check'),
        //         ]);
        //     }
        // });
    }
}
