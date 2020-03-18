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
        $fieldOfIT          = Field::create(['name'=>'Computing and Technology']);
        $fieldOfComputing   = Field::create(['name'=>'Computing']);
        $fieldOfBusiness    = Field::create(['name'=>'Business']);
        $fieldOfMarketing   = Field::create(['name'=>'Marketing']);
        $fieldOfMBA         = Field::create(['name'=>'MBA']);


        $levelBSc = Level::where('name', 'BSc')->first();
        $levelMSc = Level::where('name', 'MSc')->first();
        $levelQA = Level::where('name', 'QA partner')->first();

        $fieldOfIT->levels()->attach($levelBSc);
        $fieldOfIT->levels()->attach($levelMSc);
        $fieldOfBusiness->levels()->attach($levelMSc);
        $fieldOfBusiness->levels()->attach($levelBSc);
        $fieldOfComputing->levels()->attach($levelMSc);
        $fieldOfComputing->levels()->attach($levelBSc);
        $fieldOfMarketing->levels()->attach($levelBSc);
        $fieldOfMarketing->levels()->attach($levelMSc);
        $fieldOfMBA->levels()->attach($levelMSc);





    }
}
