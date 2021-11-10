<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = Role::create(['name' => 'administrator']);
        $role->givePermissionTo('can_manage_users');
        $role->givePermissionTo('can_manage_ticketing');
        $role->givePermissionTo('can_manage_drivers');
        $role->givePermissionTo('can_manage_busses');
    }
}
