<?php

namespace Database\Seeders;

use App\Models\User;
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
            'guard_name' => 'web'
        ]);

        // Create or get the superadmin user
        $superadmin = User::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('12345678'),
                'dob' => '2002-11-05',
                'phone' => '01234567890',
                'present_address' => 'Office Address',
                'job_title' => 'System Administrator',
                'department' => 'IT',
                'experience' => '5',
                'image' => 'public/user/admin.jpg',
                'role' => 'superadmin',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // Assign role to user
        if (!$superadmin->hasRole($role)) {
            $superadmin->assignRole($role);
        }
    }
}
