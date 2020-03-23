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

        $computingfield = Field::where('name', 'BSc Computing and Technology')->first();
        $businessfield = Field::where('name', 'BSc Business')->first();
        $marketingfield = Field::where('name', 'BSc Marketing')->first();

        //attaches user filed to an user though the roles relationship
        $admin->fields()->attach($computingfield);
        $supervisor->fields()->attach($computingfield);
        $supervisor1->fields()->attach($businessfield);
        $student->fields()->attach($computingfield);
        $student1->fields()->attach($computingfield);
        $student2->fields()->attach($businessfield);
        $student3->fields()->attach($marketingfield);

        $admin->levels()->attach($admin->fields->first()->level);
        $supervisor->levels()->attach($admin->fields->first()->level);
        $supervisor1->levels()->attach($admin->fields->first()->level);
        $student->levels()->attach($admin->fields->first()->level);
        $student1->levels()->attach($admin->fields->first()->level);
        $student2->levels()->attach($admin->fields->first()->level);
        $student3->levels()->attach($admin->fields->first()->level);


        //get the roles from DB
        $adminRole = Role::where('name', 'admin')->first();
        $supervisorRole = Role::where('name', 'supervisor')->first();
        $studentRole = Role::where('name', 'student')->first();


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
