<?php

namespace Database\Seeders;

use App\Support\RoleNames;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        foreach (RoleNames::all() as $roleName) {
            Role::findOrCreate($roleName, 'web');
        }
    }
}
