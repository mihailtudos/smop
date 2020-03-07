<?php

use App\Field;
use App\Level;
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

        //roles created on run
        $fieldOfIT = Field::create(['name'=>'IT']);
        $fieldOfManagement = Field::create(['name'=>'Management']);
        $fieldOfBM = Field::create(['name'=>'BM']);



        $levelBSc = Level::where('name', 'BSc')->first();
        $levelMSc = Level::where('name', 'MSc')->first();
        $levelQA = Level::where('name', 'QA partner')->first();

        $fieldOfIT->levels()->attach($levelBSc);
        $fieldOfIT->levels()->attach($levelMSc);
        $fieldOfBM->levels()->attach($levelMSc);
        $fieldOfManagement->levels()->attach($levelQA);
        $fieldOfBM->levels()->attach($levelQA);





    }
}
