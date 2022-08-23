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

        // Patient module
        Permission::create([
            'guard_name'=> 'web',
            'slug'      => 'create',
            'name'      =>'create_patient', 
            'module'    => 'patient'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'list',
            'name' => 'list_patient',
            'module'=> 'patient'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'update',
            'name' => 'update_patient',
            'module'=> 'patient'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'delete',
            'name' => 'delete_patient',
            'module'=> 'patient'
        ]);

        // Hospital Request module
        Permission::create([
            'guard_name'=> 'web',
            'slug'      => 'create',
            'name'      =>'create_request', 
            'module'    => 'request'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'list',
            'name' => 'list_request',
            'module'=> 'request'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'update',
            'name' => 'update_request',
            'module'=> 'request'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'delete',
            'name' => 'delete_request',
            'module'=> 'request'
        ]);

        // Blood Bag Module
        Permission::create([
            'guard_name'=> 'web',
            'slug'      => 'create',
            'name'      =>'create_bloodbag', 
            'module'    => 'bloodbag'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'list',
            'name' => 'list_bloodbag',
            'module'=> 'bloodbag'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'update',
            'name' => 'update_bloodbag',
            'module'=> 'bloodbag'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'delete',
            'name' => 'delete_bloodbag',
            'module'=> 'bloodbag'
        ]);

        // Donator Module

        Permission::create([
            'guard_name'=> 'web',
            'slug'      => 'create',
            'name'      =>'create_donator', 
            'module'    => 'donator'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'list',
            'name' => 'list_donator',
            'module'=> 'donator'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'update',
            'name' => 'update_donator',
            'module'=> 'donator'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'delete',
            'name' => 'delete_donator',
            'module'=> 'donator'
        ]);

        // Donation Module

        Permission::create([
            'guard_name'=> 'web',
            'slug'      => 'create',
            'name'      =>'create_donation', 
            'module'    => 'donation'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'list',
            'name' => 'list_donation',
            'module'=> 'donation'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'update',
            'name' => 'update_donation',
            'module'=> 'donation'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'delete',
            'name' => 'delete_donation',
            'module'=> 'donation'
        ]);

        // donation Request

        Permission::create([
            'guard_name'=> 'web',
            'slug'      => 'create',
            'name'      =>'create_donationRequest', 
            'module'    => 'donationRequest'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'list',
            'name' => 'list_donationRequest',
            'module'=> 'donationRequest'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'update',
            'name' => 'update_donationRequest',
            'module'=> 'donationRequest'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'delete',
            'name' => 'delete_donationRequest',
            'module'=> 'donationRequest'
        ]);

        // Campaigns Module

        Permission::create([
            'guard_name'=> 'web',
            'slug'      => 'create',
            'name'      =>'create_campaign', 
            'module'    => 'campaign'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'list',
            'name' => 'list_campaign',
            'module'=> 'campaign'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'update',
            'name' => 'update_campaign',
            'module'=> 'campaign'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'delete',
            'name' => 'delete_campaign',
            'module'=> 'campaign'
        ]);

        // Report Module

        Permission::create([
            'guard_name'=> 'web',
            'slug'      => 'create',
            'name'      =>'create_report', 
            'module'    => 'report'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'list',
            'name' => 'list_report',
            'module'=> 'report'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'update',
            'name' => 'update_report',
            'module'=> 'report'
        ]);
        Permission::create([
            'guard_name' => 'web',
            'slug' => 'delete',
            'name' => 'delete_report',
            'module'=> 'report'
        ]);


    }
}
