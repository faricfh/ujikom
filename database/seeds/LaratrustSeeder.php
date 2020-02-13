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
        $superadminRole = new App\Role();
        $superadminRole->name         = 'superadmin';
        $superadminRole->display_name = 'SuperAdmin'; // optional
        $superadminRole->save();

        $adminRole = new App\Role();
        $adminRole->name         = 'admin';
        $adminRole->display_name = 'Admin'; // optional
        $adminRole->save();

        $superadmin = new App\User();
        $superadmin->name = "AdminFShop";
        $superadmin->email = "admin@fshop.com";
        $superadmin->password = bcrypt('adminfshop');
        $superadmin->save();
        $superadmin->attachRole($superadminRole);

        $admin = new App\User();
        $admin->name = "Admin";
        $admin->email = "admin@gmail.com";
        $admin->password = bcrypt('admin123');
        $admin->save();
        $admin->attachRole($adminRole);
    }
}
