<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Permission::class => \App\Policies\PermissionPolicy::class,
        Role::class => \App\Policies\RolePolicy::class,
        User::class => \App\Policies\UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();

        // Implicitly grant "super-admin" role all permission checks using can()
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('super-admin')) {
                return true;
            }
        });
    }
}
