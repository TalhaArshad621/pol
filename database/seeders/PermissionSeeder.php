<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User Permissions
        Permission::create([
            'guard_name'=> 'web',
            'slug'      => 'create',
            'name'      =>'create_user', 
            'module'    => 'User'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'list',
            'name' => 'list_user',
            'module'=> 'User'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'update',
            'name' => 'update_user',
            'module'=> 'User'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'delete',
            'name' => 'delete_user',
            'module'=> 'User'
        ]);
         
        // User Group Permissions
        Permission::create([
            'guard_name'=> 'web',
            'slug'      => 'create',
            'name'      =>'create_userGroup', 
            'module'    => 'usergroup'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'list',
            'name' => 'list_userGroup',
            'module'=> 'usergroup'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'update',
            'name' => 'update_userGroup',
            'module'=> 'usergroup'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'delete',
            'name' => 'delete_userGroup',
            'module'=> 'usergroup'
        ]);
    }
}
