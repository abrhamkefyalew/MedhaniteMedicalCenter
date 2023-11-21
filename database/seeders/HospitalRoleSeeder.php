<?php

namespace Database\Seeders;

use App\Models\HospitalRole;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HospitalRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $hospitalRoles = [
            [
                'hospital_role_title' => HospitalRole::HOSPITAL_ADMIN_ADMIN_ROLE,
                'is_system_created' => true,
            ],
            [
                'hospital_role_title' => HospitalRole::HOSPITAL_ADMIN_ROLE,
                'is_system_created' => true,
            ],
            [
                'hospital_role_title' => HospitalRole::HOSPITAL_WORKER_ROLE,
                'is_system_created' => true,
            ],
        ];

        HospitalRole::upsert($hospitalRoles, ['hospital_role_title']);
    }
}
