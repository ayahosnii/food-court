<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ProviderRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define provider permissions
        $providerPermissions = [
            'provider:create-tables',
            'provider:edit-tables',
            'provider:delete-tables',
        ];

        foreach ($providerPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create a provider role
        $providerRole = Role::create(['name' => 'provider']);

        // Assign provider permissions to the provider role
        $providerRole->syncPermissions($providerPermissions);
    }
}
