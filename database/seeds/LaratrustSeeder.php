<?php

use Illuminate\Database\Seeder;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = new App\Role();
        $superadmin->name         = 'superadmin';
        $superadmin->display_name = 'SuperAdmin'; // optional
        $superadmin->save();

        $admin = new App\Role();
        $admin->name         = 'admin';
        $admin->display_name = 'Admin'; // optional
        $admin->save();

        $permissionSA = new App\Permission();
        $permissionSA->name         = 'crud-all';
        $permissionSA->display_name = 'CRUD-ALL'; // optional
        // Allow a user to...
        $permissionSA->save();

        $permissionA = new App\Permission();
        $permissionA->name         = 'crud-noall';
        $permissionA->display_name = 'CRUD-NoAll'; // optional
        // Allow a user to...
        $permissionA->save();
    }
}
