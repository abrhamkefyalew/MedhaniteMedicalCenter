<?php

namespace App\Policies;

use App\Models\Hospital;
// use App\Models\User;
use App\Models\Permission;
use App\Models\Admin as User;
use Illuminate\Auth\Access\Response;

class HospitalPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return $user->permissions()->where('permissions.title', Permission::INDEX_HOSPITAL)->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Hospital $hospital): bool
    {
        //
        return $user->permissions()->where('permissions.title', Permission::SHOW_HOSPITAL)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->permissions()->where('permissions.title', Permission::CREATE_HOSPITAL)->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Hospital $hospital): bool
    {
        //
        return $user->permissions()->where('permissions.title', Permission::EDIT_HOSPITAL)->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Hospital $hospital): bool
    {
        //
        return $user->permissions()->where('permissions.title', Permission::DELETE_HOSPITAL)->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Hospital $hospital): bool
    {
        //
        return $user->permissions()->where('permissions.title', Permission::RESTORE_HOSPITAL)->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Hospital $hospital): bool
    {
        // return false;
    }
}
