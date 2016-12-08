<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permission_role')->delete();
        DB::table('roles')->delete();
        DB::table('permissions')->delete();

        $admin_role = new Role;
        $admin_role->name = 'admin';
        $admin_role->save();

        $vendor_role = new Role;
        $vendor_role->name = 'vendor';
        $vendor_role->save();

        $user_role = new Role;
        $user_role->name = 'user';
        $user_role->save();

        /* Permissions */
        $manage_users = new Permission();
        $manage_users->name = 'manage_users';
        $manage_users->display_name = 'Can Manage Users';
        $manage_users->save();

        $admin_role->attachPermission($manage_users);

        $manage_company = new Permission();
        $manage_company->name = 'manage_company';
        $manage_company->display_name = 'Can Manage Company';
        $manage_company->save();

        $vendor_role->attachPermission($manage_company);

        $user = User::where('email','=','admin')->first();
        $user->attachRole( $admin_role );

    }
}