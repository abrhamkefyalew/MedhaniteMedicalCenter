<?php

namespace App\Policies;

use App\Models\Admin as User;
use App\Models\Permission;
use App\Models\DoctorHospital;
use Illuminate\Auth\Access\Response;

class DoctorHospitalPolicy
{

    /**
     * Determine whether the user can sync any models.
     */
    public function sync(User $user): bool
    {
        return $user->permissions()->where('permissions.title', Permission::SYNC_HOSPITAL_DOCTOR)->exists();
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->permissions()->where('permissions.title', Permission::INDEX_HOSPITAL_DOCTOR)->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DoctorHospital $doctorHospital): bool
    {
        return $user->permissions()->where('permissions.title', Permission::SHOW_HOSPITAL_DOCTOR)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->permissions()->where('permissions.title', Permission::CREATE_HOSPITAL_DOCTOR)->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DoctorHospital $doctorHospital): bool
    {
        return $user->permissions()->where('permissions.title', Permission::EDIT_HOSPITAL_DOCTOR)->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DoctorHospital $doctorHospital): bool
    {
        return $user->permissions()->where('permissions.title', Permission::DELETE_HOSPITAL_DOCTOR)->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DoctorHospital $doctorHospital): bool
    {
        return $user->permissions()->where('permissions.title', Permission::RESTORE_HOSPITAL_DOCTOR)->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DoctorHospital $doctorHospital): bool
    {
        //
    }
}
