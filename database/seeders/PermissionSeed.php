<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Artisan;



class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Artisan::call('cache:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        Permission::create(['name' => 'can_manage_users']);
        Permission::create(['name' => 'can_manage_ticketing']);
        Permission::create(['name' => 'can_manage_drivers']);
        Permission::create(['name' => 'can_manage_busses']);




    }
}
