<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Role::create([
            'name' => 'manager',
        ])->givePermissionTo(Permission::all()->pluck('name'));

        Role::create([
            'name' => 'agent',
        ])->givePermissionTo('candidatos.access_own', 'candidatos.edit');
    }
}
