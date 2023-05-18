<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::firstOrCreate([
            'id' => 1,
            'email' => 'medhanite_medical_centers@admin.com',
        ], [
            'first_name' => 'AdminMedCenters',
            'last_name' => 'AdminMedCenters',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $role_id = Role::where('title', Role::SUPER_ADMIN_ROLE)->first('id')->id;

        $admin->roles()->sync($role_id);
    }
}
