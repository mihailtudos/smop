<?php

use App\Field;
use Illuminate\Database\Seeder;

class FieldTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //will drip roles table at each run in order to create new data
        Field::truncate();

        //roles created on run
        Field::create(['name'=>'IT']);
        Field::create(['name'=>'Management']);
        Field::create(['name'=>'BM']);
    }
}
