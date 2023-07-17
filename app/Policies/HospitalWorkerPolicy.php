<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\Admin as User;
use App\Models\HospitalWorker;
use Illuminate\Auth\Access\Response;

class HospitalWorkerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->permissions()->where('permissions.title', Permission::INDEX_HOSPITAL_STAFF)->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, HospitalWorker $hospitalWorker): bool
    {
        return $user->permissions()->where('permissions.title', Permission::SHOW_HOSPITAL_STAFF)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->permissions()->where('permissions.title', Permission::CREATE_HOSPITAL_STAFF)->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, HospitalWorker $hospitalWorker): bool
    {
        return $user->permissions()->where('permissions.title', Permission::EDIT_HOSPITAL_STAFF)->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, HospitalWorker $hospitalWorker): bool
    {
        return $user->permissions()->where('permissions.title', Permission::DELETE_HOSPITAL_STAFF)->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, HospitalWorker $hospitalWorker): bool
    {
        return $user->permissions()->where('permissions.title', Permission::RESTORE_HOSPITAL_STAFF)->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, HospitalWorker $hospitalWorker): bool
    {
        // return false;
    }
}
