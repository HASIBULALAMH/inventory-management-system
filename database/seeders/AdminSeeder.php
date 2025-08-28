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
                'name' => 'superadmin',
                'password' => bcrypt('12345678')
            ]
        );

        // Assign role to user
        if (!$superadmin->hasRole($role)) {
            $superadmin->assignRole($role);
        }
    }
}
