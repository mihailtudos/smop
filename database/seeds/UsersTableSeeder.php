<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use \App\User;
use \App\Role;
use \App\Field;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //will drip roles table at each run in order to create new data
        //User::truncate();
        //DB::table('role_user')->truncate();
        //DB::table('field_user')->truncate();

        //get the roles from DB
        $adminRole = Role::where('name', 'admin')->first();
        $supervisorRole = Role::where('name', 'supervisor')->first();
        $studentRole = Role::where('name', 'student')->first();

        $ITRole = Field::where('name', 'IT')->first();
        $BMRole = Field::where('name', 'BM')->first();
        $ManagementRole = Field::where('name', 'Management')->first();

        //Creates user of admin role
       $admin = User::create([
           'name' => 'Admin User',
           'email' => 'admin@admin.com',
           'password' => Hash::make('12345678')
       ]);
        //Creates user of supervisor role
        $supervisor = User::create([
           'name' => 'Supervisor User',
           'email' => 'super@admin.com',
           'password' => Hash::make('12345678')
       ]);
        //Creates user of student role
       $student = User::create([
           'name' => 'Student User',
           'email' => 'student@admin.com',
           'password' => Hash::make('12345678')
       ]);

        //attaches user filed to an user though the roles relationship
        $admin->fields()->attach($ITRole);
        $supervisor->fields()->attach($BMRole);
        $student->fields()->attach($ManagementRole);

       //attaches user role to an user though the roles relationship
        $admin->roles()->attach($adminRole);
        $supervisor->roles()->attach($supervisorRole);
        $student->roles()->attach($studentRole);
    }
}
