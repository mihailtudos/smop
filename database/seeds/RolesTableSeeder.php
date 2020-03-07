<?php

use Illuminate\Database\Seeder;
use \App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //will drip roles table at each run in order to create new data

        //roles created on run
        Role::create(['name'=>'admin']);
        Role::create(['name'=>'supervisor']);
        Role::create(['name'=>'student']);
    }
}
