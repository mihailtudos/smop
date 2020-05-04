<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RolesTableSeeder::class);
         $this->call(LevelsTableSeeder::class);
         $this->call(FieldTableSeeder::class);
         $this->call(SubjectsTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(ActivityTitlesTableSeeder::class);
         $this->call(DiryRecordsTableSeeder::class);
         $this->call(PostsTableSeeder::class);

    }
}
