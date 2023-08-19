<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // [
        //     'title' => Permission::INDEX_abcd,
        // ],
        // [
        //     'title' => Permission::SHOW_abcd,
        // ],
        // [
        //     'title' => Permission::CREATE_abcd,
        // ],
        // [
        //     'title' => Permission::EDIT_abcd,
        // ],
        // [
        //     'title' => Permission::DELETE_abcd,
        // ],
        // [
        //     'title' => Permission::RESTORE_abcd,
        // ],

        $adminPermissions = Permission::all();

        $managerPermissions = $adminPermissions->filter(function ($permission) {
            return substr($permission->title, 0, 6) != 'DELETE' &&
                   strpos($permission->title, 'RESTORE') === false &&
                   strpos($permission->title, 'ROLE') === false &&
                   strpos($permission->title, 'PERMISSION') === false &&
                   strpos($permission->title, 'SEND') === false;
        });

        $viewerPermissions = $adminPermissions->filter(function ($permission) {
            return strpos($permission->title, 'DELETE') === false &&
                strpos($permission->title, 'RESTORE') === false &&
                strpos($permission->title, 'EDIT') === false &&
                strpos($permission->title, 'CREATE') === false &&
                strpos($permission->title, 'ROLE') === false &&
                strpos($permission->title, 'PERMISSION') === false &&
                strpos($permission->title, 'SEND') === false;
        });

        // this will insert (sync) in $role->permission() relation (permission_role table)
        Role::where('title', Role::SUPER_ADMIN_ROLE)->firstOrFail()->permissions()->sync($adminPermissions);
        Role::where('title', Role::MANAGER_ROLE)->firstOrFail()->permissions()->sync($managerPermissions);
        Role::where('title', Role::VIEWER_ROLE)->firstOrFail()->permissions()->sync($viewerPermissions);
        
    }
}
