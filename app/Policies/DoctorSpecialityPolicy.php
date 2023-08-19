<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Permission;
use App\Models\DoctorSpeciality;
use Illuminate\Auth\Access\Response;

class DoctorSpecialityPolicy
{

    /**
     * Determine whether the user can sync any models.
     */
    public function sync(User $user): bool
    {
        return $user->permissions()->where('permissions.title', Permission::SYNC_DOCTOR_SPECIALITY)->exists();
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->permissions()->where('permissions.title', Permission::INDEX_DOCTOR_SPECIALITY)->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DoctorSpeciality $doctorSpeciality): bool
    {
        return $user->permissions()->where('permissions.title', Permission::SHOW_DOCTOR_SPECIALITY)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->permissions()->where('permissions.title', Permission::CREATE_DOCTOR_SPECIALITY)->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DoctorSpeciality $doctorSpeciality): bool
    {
        return $user->permissions()->where('permissions.title', Permission::EDIT_DOCTOR_SPECIALITY)->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DoctorSpeciality $doctorSpeciality): bool
    {
        return $user->permissions()->where('permissions.title', Permission::DELETE_DOCTOR_SPECIALITY)->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DoctorSpeciality $doctorSpeciality): bool
    {
        return $user->permissions()->where('permissions.title', Permission::RESTORE_DOCTOR_SPECIALITY)->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DoctorSpeciality $doctorSpeciality): bool
    {
        //
    }
}
