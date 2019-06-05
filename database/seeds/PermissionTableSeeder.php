<?php


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $permissionsAdmin = [
           'permission-list',
           'permission-create',
           'permission-edit',
           'permission-delete',

           'role-list',
           'role-create',
           'role-edit',
           'role-delete'];

       $permissionsSuperuser = [
           'user-list',
           'user-create',
           'user-edit',
           'user-delete'];

       $permissions = array_merge(
          $permissionsAdmin,
          $permissionsSuperuser);

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
        $admin = Role::create(['name' => 'admin']);
        $admin->syncPermissions($permissions);

        $superuser = Role::create(['name' => 'superuser']);
        $superuser->syncPermissions($permissionsSuperuser);
    }
}