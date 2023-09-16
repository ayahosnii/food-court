<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define admin permissions
        $adminPermissions = [
            'admin:create-users',
            'admin:edit-users',
            'admin:delete-users',
            // Add more admin-related permissions as needed
        ];

        foreach ($adminPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create an admin role
        $adminRole = Role::create(['name' => 'admin']);

        // Assign admin permissions to the admin role
        $adminRole->syncPermissions($adminPermissions);
    }
}
