<?php

use Illuminate\Database\Seeder;

class DiryRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        \App\Diary::create([
           'title' => 'New diary record',
            'completed' => 'Nothing completed',
            'notes' => 'Nothing completed',
            'todo' => 'Nothing completed',
            'meeting_id' => null,
            'user_id' => 4,
        ]);
    }
}
