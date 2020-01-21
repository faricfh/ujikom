<?php

use Illuminate\Database\Seeder;
class user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ]);

        App\User::create([
            'name' => 'AdminFShop',
            'email' => 'admin@fshop.test',
            'password' => bcrypt('adminfshop')
        ]);
    }
}
