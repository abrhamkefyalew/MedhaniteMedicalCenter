<?php

namespace App\Policies;

use App\Models\Admin as User;
use App\Models\Permission;
use App\Models\HospitalSpeciality;
use Illuminate\Auth\Access\Response;

class HospitalSpecialityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->permissions()->where('permissions.title', Permission::INDEX_HOSPITAL_SPECIALITY)->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, HospitalSpeciality $hospitalSpeciality): bool
    {
        return $user->permissions()->where('permissions.title', Permission::SHOW_HOSPITAL_SPECIALITY)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->permissions()->where('permissions.title', Permission::CREATE_HOSPITAL_SPECIALITY)->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, HospitalSpeciality $hospitalSpeciality): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, HospitalSpeciality $hospitalSpeciality): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, HospitalSpeciality $hospitalSpeciality): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, HospitalSpeciality $hospitalSpeciality): bool
    {
        //
    }
}
