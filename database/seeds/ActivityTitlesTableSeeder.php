<?php

use App\ActivityTitle;
use Illuminate\Database\Seeder;

class ActivityTitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActivityTitle::create([
            'activity_title'=>'new topic submitted'
        ]);

        ActivityTitle::create([
            'activity_title'=>'new post created'
        ]);

        ActivityTitle::create([
            'activity_title'=>'new ethical form submitted'
        ]);

        ActivityTitle::create([
            'activity_title'=>'updated topic'
        ]);

        ActivityTitle::create([
            'activity_title'=>'assigned to project'
        ]);

    }
}
