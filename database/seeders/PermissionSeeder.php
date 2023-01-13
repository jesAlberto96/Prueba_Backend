<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // users permissions
        Permission::create(['name' => 'candidatos.access']);
        Permission::create(['name' => 'candidatos.access_own']);
        Permission::create(['name' => 'candidatos.create']);
        Permission::create(['name' => 'candidatos.edit']);
        Permission::create(['name' => 'candidatos.delete']);
    }
}
