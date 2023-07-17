<?php

namespace App\Policies;

use App\Models\Doctor;
use App\Models\Permission;
use App\Models\Admin as User;
use Illuminate\Auth\Access\Response;

class DoctorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->permissions()->where('permissions.title', Permission::INDEX_DOCTOR)->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Doctor $doctor): bool
    {
        return $user->permissions()->where('permissions.title', Permission::SHOW_DOCTOR)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->permissions()->where('permissions.title', Permission::CREATE_DOCTOR)->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Doctor $doctor): bool
    {
        return $user->permissions()->where('permissions.title', Permission::EDIT_DOCTOR)->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Doctor $doctor): bool
    {
        return $user->permissions()->where('permissions.title', Permission::DELETE_DOCTOR)->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Doctor $doctor): bool
    {
        return $user->permissions()->where('permissions.title', Permission::RESTORE_DOCTOR)->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Doctor $doctor): bool
    {
        // return false;
    }
}
