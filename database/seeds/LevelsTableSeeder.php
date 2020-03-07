<?php

use App\Field;
use App\Level;
use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //will drip roles table at each run in order to create new data
        //Level::truncate();



        //roles created on run
        Level::create(['name'=>'BSc']);
        Level::create(['name'=>'MSc']);
        Level::create(['name'=>'QA partner']);


    }
}
