<?php

namespace App\Policies;

use App\Models\TaskHasDefect;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskHasDefectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('viewAny: task_has_defects');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TaskHasDefect $taskHasDefect): bool
    {
        return $user->hasPermissionTo('view: task_has_defects');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create: task_has_defects');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TaskHasDefect $taskHasDefect): bool
    {
        return $user->hasPermissionTo('update: task_has_defects');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TaskHasDefect $taskHasDefect): bool
    {
        return $user->hasPermissionTo('delete: task_has_defects');
    }
}
