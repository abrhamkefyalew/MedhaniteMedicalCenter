<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'title' => Permission::INDEX_ROLE,
            ],
            [
                'title' => Permission::SHOW_ROLE,
            ],
            [
                'title' => Permission::CREATE_ROLE,
            ],
            [
                'title' => Permission::EDIT_ROLE,
            ],
            [
                'title' => Permission::DELETE_ROLE,
            ],
            [
                'title' => Permission::RESTORE_ROLE,
            ],
            [
                'title' => Permission::INDEX_PERMISSION,
            ],
            [
                'title' => Permission::SHOW_PERMISSION,
            ],
            [
                'title' => Permission::INDEX_PERMISSION_ROLE,
            ],
            [
                'title' => Permission::SHOW_PERMISSION_ROLE,
            ],
            [
                'title' => Permission::CREATE_PERMISSION_ROLE,
            ],
            [
                'title' => Permission::EDIT_PERMISSION_ROLE,
            ],
            [
                'title' => Permission::DELETE_PERMISSION_ROLE,
            ],
            [
                'title' => Permission::RESTORE_PERMISSION_ROLE,
            ],
            [
                'title' => Permission::INDEX_ADMIN,
            ],
            [
                'title' => Permission::SHOW_ADMIN,
            ],
            [
                'title' => Permission::CREATE_ADMIN,
            ],
            [
                'title' => Permission::EDIT_ADMIN,
            ],
            [
                'title' => Permission::DELETE_ADMIN,
            ],
            [
                'title' => Permission::RESTORE_ADMIN,
            ],
            [
                'title' => Permission::INDEX_ROLE_ADMIN,
            ],
            [
                'title' => Permission::SHOW_ROLE_ADMIN,
            ],
            [
                'title' => Permission::CREATE_ROLE_ADMIN,
            ],
            [
                'title' => Permission::EDIT_ROLE_ADMIN,
            ],
            [
                'title' => Permission::DELETE_ROLE_ADMIN,
            ],
            [
                'title' => Permission::RESTORE_ROLE_ADMIN,
            ],
            [
                'title' => Permission::INDEX_HOSPITAL,
            ],
            [
                'title' => Permission::SHOW_HOSPITAL,
            ],
            [
                'title' => Permission::CREATE_HOSPITAL,
            ],
            [
                'title' => Permission::EDIT_HOSPITAL,
            ],
            [
                'title' => Permission::DELETE_HOSPITAL,
            ],
            [
                'title' => Permission::RESTORE_HOSPITAL,
            ],
            [
                'title' => Permission::INDEX_HOSPITAL_ROLE,
            ],
            [
                'title' => Permission::SHOW_HOSPITAL_ROLE,
            ],
            [
                'title' => Permission::CREATE_HOSPITAL_ROLE,
            ],
            [
                'title' => Permission::EDIT_HOSPITAL_ROLE,
            ],
            [
                'title' => Permission::DELETE_HOSPITAL_ROLE,
            ],
            [
                'title' => Permission::RESTORE_HOSPITAL_ROLE,
            ],
            [
                'title' => Permission::INDEX_HOSPITAL_SPECIALITY,
            ],
            [
                'title' => Permission::SHOW_HOSPITAL_SPECIALITY,
            ],
            [
                'title' => Permission::CREATE_HOSPITAL_SPECIALITY,
            ],
            [
                'title' => Permission::EDIT_HOSPITAL_SPECIALITY,
            ],
            [
                'title' => Permission::DELETE_HOSPITAL_SPECIALITY,
            ],
            [
                'title' => Permission::RESTORE_HOSPITAL_SPECIALITY,
            ],
            [
                'title' => Permission::INDEX_SPECIALITY,
            ],
            [
                'title' => Permission::SHOW_SPECIALITY,
            ],
            [
                'title' => Permission::CREATE_SPECIALITY,
            ],
            [
                'title' => Permission::EDIT_SPECIALITY,
            ],
            [
                'title' => Permission::DELETE_SPECIALITY,
            ],
            [
                'title' => Permission::RESTORE_SPECIALITY,
            ],
            [
                'title' => Permission::INDEX_HOSPITAL_STAFF,
            ],
            [
                'title' => Permission::SHOW_HOSPITAL_STAFF,
            ],
            [
                'title' => Permission::CREATE_HOSPITAL_STAFF,
            ],
            [
                'title' => Permission::EDIT_HOSPITAL_STAFF,
            ],
            [
                'title' => Permission::DELETE_HOSPITAL_STAFF,
            ],
            [
                'title' => Permission::RESTORE_HOSPITAL_STAFF,
            ],
            [
                'title' => Permission::INDEX_DOCTOR,
            ],
            [
                'title' => Permission::SHOW_DOCTOR,
            ],
            [
                'title' => Permission::CREATE_DOCTOR,
            ],
            [
                'title' => Permission::EDIT_DOCTOR,
            ],
            [
                'title' => Permission::DELETE_DOCTOR,
            ],
            [
                'title' => Permission::RESTORE_DOCTOR,
            ],
            [
                'title' => Permission::INDEX_EQUIPMENT_TYPE,
            ],
            [
                'title' => Permission::SHOW_EQUIPMENT_TYPE,
            ],
            [
                'title' => Permission::CREATE_EQUIPMENT_TYPE,
            ],
            [
                'title' => Permission::EDIT_EQUIPMENT_TYPE,
            ],
            [
                'title' => Permission::DELETE_EQUIPMENT_TYPE,
            ],
            [
                'title' => Permission::RESTORE_EQUIPMENT_TYPE,
            ],
            [
                'title' => Permission::INDEX_EQUIPMENT,
            ],
            [
                'title' => Permission::SHOW_EQUIPMENT,
            ],
            [
                'title' => Permission::CREATE_EQUIPMENT,
            ],
            [
                'title' => Permission::EDIT_EQUIPMENT,
            ],
            [
                'title' => Permission::DELETE_EQUIPMENT,
            ],
            [
                'title' => Permission::RESTORE_EQUIPMENT,
            ],
        ];
        

        Permission::upsert($permissions, ['title']);
    }
}
