<?php

namespace App\Policies;

use App\Models\Defect;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DefectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('viewAny: defects');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Defect $defect): bool
    {
        return $user->hasPermissionTo('view: defects');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create: defects');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Defect $defect): bool
    {
        return $user->hasPermissionTo('update: defects');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Defect $defect): bool
    {
        return $user->hasPermissionTo('delete: defects');
    }
}
