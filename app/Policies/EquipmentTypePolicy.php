<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\Admin as User;
use App\Models\EquipmentType;
use Illuminate\Auth\Access\Response;

class EquipmentTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return $user->permissions()->where('permissions.title', Permission::INDEX_EQUIPMENT_TYPE)->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EquipmentType $equipmentType): bool
    {
        //
        return $user->permissions()->where('permissions.title', Permission::SHOW_EQUIPMENT_TYPE)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->permissions()->where('permissions.title', Permission::CREATE_EQUIPMENT_TYPE)->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EquipmentType $equipmentType): bool
    {
        //
        return $user->permissions()->where('permissions.title', Permission::EDIT_EQUIPMENT_TYPE)->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EquipmentType $equipmentType): bool
    {
        //
        return $user->permissions()->where('permissions.title', Permission::DELETE_EQUIPMENT_TYPE)->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EquipmentType $equipmentType): bool
    {
        //
        return $user->permissions()->where('permissions.title', Permission::RESTORE_EQUIPMENT_TYPE)->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EquipmentType $equipmentType): bool
    {
        //
    }
}
