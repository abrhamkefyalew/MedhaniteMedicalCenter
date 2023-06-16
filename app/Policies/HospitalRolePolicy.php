<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\HospitalRole;
use App\Models\Admin as User;
use Illuminate\Auth\Access\Response;

class HospitalRolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return $user->permissions()->where('permissions.title', Permission::INDEX_HOSPITAL_ROLE)->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, HospitalRole $hospitalRole): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, HospitalRole $hospitalRole): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, HospitalRole $hospitalRole): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, HospitalRole $hospitalRole): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, HospitalRole $hospitalRole): bool
    {
        //
    }
}
