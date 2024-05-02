<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Reset cached roles and permissions
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         // create permissions
         // Permission::create(['name' => 'edit articles']);
         // Permission::create(['name' => 'delete articles']);
         // Permission::create(['name' => 'publish articles']);
         // Permission::create(['name' => 'unpublish articles']);
 
        //  best way to create bulk permissions
         $arrayOfPermissionNames = ['edit_articles', 'delete_articles','publish_articles','unpublish_articles'];
         $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
             return ['name' => $permission, 'guard_name' => 'web'];
         });
         
        //Permission::insert($permissions->toArray());
        // create roles and assign created permissions
        //  $role = Role::create(['name' => 'USER','guard_name'=>'api','team_id'=>1])->givePermissionTo($arrayOfPermissionNames);
         //$role = Role::create(['name' => 'USER','guard_name'=>'web'])->givePermissionTo($arrayOfPermissionNames);
         //$role = Role::create(['name' => 'ADMIN','guard_name'=>'web'])->givePermissionTo($arrayOfPermissionNames);
        //  $role = Role::create(['name' => 'SUPER_ADMIN','guard_name'=>'web'])->givePermissionTo($arrayOfPermissionNames);
        // $role = Role::create(['name' => 'USER','guard_name'=>'api']);
        // $role = Role::create(['name' => 'ADMIN','guard_name'=>'api']);
        // $role = Role::create(['name' => 'SUPER_ADMIN','guard_name'=>'api']);


         // Set TeamId
         $user=User::find(1);
        //  setPermissionsTeamId($user->id);
         $user->assignRole('USER');
          
         //dd(User::doesntHave('roles')->get());
         //dd(Role::all()->pluck('name'));
         //$user->removeRole('admin');
         //$user->assignRole(['admin']);
         //$user->syncRoles(['admin']);
 
 
         
    }
}
