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
//        User::truncate();
//        DB::table('role_user')->truncate();
//        DB::table('field_user')->truncate();

        //get the roles from DB
        $adminRole = Role::where('name', 'admin')->first();
        $supervisorRole = Role::where('name', 'supervisor')->first();
        $studentRole = Role::where('name', 'student')->first();


        $ITRole = Field::where('name', 'BSc Computing and Technology')->first();
        $BMRole = Field::where('name', 'BSc Business')->first();
        $ManagementRole = Field::where('name', 'BSc Marketing')->first();

        //Creates user of admin role
       $admin = User::create([
           'name' => 'Admin User',
           'email' => 'admin@admin.com',
           'password' => Hash::make('12345678')
       ]);

        $admin->profile()->create([]);

        //Creates user of supervisor role
        $supervisor = User::create([
           'name' => 'Supervisor User',
           'email' => 'super@admin.com',
           'password' => Hash::make('12345678')
       ]);

        $supervisor->profile()->create([]);

        $supervisor1 = User::create([
           'name' => 'Supervisor User1',
           'email' => 'super1@admin.com',
           'password' => Hash::make('12345678')
       ]);
        $supervisor1->profile()->create([]);


        //Creates user of student role
       $student = User::create([
           'name' => 'Student User',
           'email' => 'student@admin.com',
           'password' => Hash::make('12345678')
       ]);
        $student->profile()->create([]);

        $student1 = User::create([
            'name' => 'Student User1',
            'email' => 'student1@admin.com',
            'password' => Hash::make('12345678')
        ]);
        $student1->profile()->create([]);

        $student2 = User::create([
            'name' => 'Student User2',
            'email' => 'student2@admin.com',
            'password' => Hash::make('12345678')
        ]);
        $student2->profile()->create([]);

        $student3 = User::create([
            'name' => 'Student User3',
            'email' => 'student4@admin.com',
            'password' => Hash::make('12345678')
        ]);
        $student3->profile()->create([]);


        //attaches user filed to an user though the roles relationship
        $admin->fields()->attach($ITRole);
        $admin->fields()->attach($ITRole);
        $supervisor->fields()->attach($ITRole);
        $supervisor1->fields()->attach($ITRole);
        $student->fields()->attach($ITRole);
        $student1->fields()->attach($ITRole);
        $student2->fields()->attach($BMRole);
        $student3->fields()->attach($ManagementRole);

       //attaches user role to an user though the roles relationship
        $admin->roles()->attach($adminRole);
        $supervisor->roles()->attach($supervisorRole);
        $supervisor1->roles()->attach($supervisorRole);
        $student->roles()->attach($studentRole);
        $student1->roles()->attach($studentRole);
        $student2->roles()->attach($studentRole);
        $student3->roles()->attach($studentRole);
    }
}
