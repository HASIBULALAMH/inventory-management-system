<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or get the superadmin role
        $role = Role::firstOrCreate(['name' => 'superadmin'], [
            'guard_name' => 'web',
            'dashboard_route' => 'admin.dashboard', // Add default dashboard route
            'status' => 'active',
            'icon' => 'fa-user-shield'
        ]);

        // Create a department if not exists
        $department = Department::firstOrCreate(
            ['name' => 'IT'],
            [
                'code' => 'IT',
                'status' => 'active'
            ]
        );

        // Create a designation if not exists
        $designation = Designation::firstOrCreate(
            ['name' => 'System Administrator'],
            [
                'code' => 'SYSADM',
                'department_id' => $department->id,
                'status' => 'active'
            ]
        );

        // Create or get the superadmin user
        $superadmin = User::firstOrCreate(
            ['email' => 'superadmin@storify.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('12345678'),
                'phone' => '01234567890',
                'gender' => 'male',
                'dob' => '2002-11-05',
                'present_address' => 'Office Address',
                'permanent_address' => 'Office Address',
                'employee_id' => 'SYS-ADM-001',
                'department_id' => $department->id,
                'designation_id' => $designation->id,
                'join_date' => now(),
                'profile_photo' => 'admin.jpg',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // Assign role to user
        if (!$superadmin->hasRole($role->name)) {
            $superadmin->assignRole($role->name);
        }
    }
}
