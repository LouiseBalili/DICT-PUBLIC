<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $role_admin = Role::create(['name' => 'Administrator']);
        $role_user = Role::create(['name' => 'User']);

        Permission::create(['name' => 'create-category']);
        Permission::create(['name' => 'edit-category']);
        Permission::create(['name' => 'delete-category']);

        Permission::create(['name' => 'create-subcategory']);
        Permission::create(['name' => 'edit-subcategory']);
        Permission::create(['name' => 'delete-subcategory']);

        Permission::create(['name' => 'create-office']);
        Permission::create(['name' => 'edit-office']);
        Permission::create(['name' => 'delete-office']);

        Permission::create(['name' => 'create-employee']);
        Permission::create(['name' => 'edit-employee']);
        Permission::create(['name' => 'delete-employee']);

        $users = User::all();

        foreach($users as $user) {
            $user->assignRole('Administrator');
        }
    }
}
