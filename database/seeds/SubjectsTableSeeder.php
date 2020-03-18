<?php

use App\Field;
use App\Subject;
use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //subjects created on run
        $cyber              = Subject::create(['name'=>'Cyber Security']);
        $networking         = Subject::create(['name'=>'Networking']);
        $hardware           = Subject::create(['name'=>'Hardware']);
        $pm                 = Subject::create(['name'=>'Project Management']);
        $web                = Subject::create(['name'=>'Web Technologies']);
        $mobApp             = Subject::create(['name'=>'Mobile Applications']);
        $strategy           = Subject::create(['name'=>'Strategy']);
        $marketing          = Subject::create(['name'=>'Marketing']);
        $entrepreneurship   = Subject::create(['name'=>'Entrepreneurship']);
        $operations         = Subject::create(['name'=>'Operations']);
        $economics          = Subject::create(['name'=>'Economics']);
        $finance            = Subject::create(['name'=>'Finance']);
        $accounting         = Subject::create(['name'=>'Accounting']);

        $fieldOfComputingAndTech    = Field::where('name', 'Computing and Technology')->first();
        $fieldOfComputing           = Field::where('name', 'Computing')->first();
        $fieldOfBusiness            = Field::where('name', 'Business')->first();
        $fieldOfMarketing           = Field::where('name', 'Marketing')->first();
        $fieldOfMBA                 = Field::where('name', 'MBA')->first();

        $fieldOfComputingAndTech->subjects()->attach($cyber);
        $fieldOfComputingAndTech->subjects()->attach($networking);
        $fieldOfComputingAndTech->subjects()->attach($hardware);
        $fieldOfComputingAndTech->subjects()->attach($web);
        $fieldOfComputingAndTech->subjects()->attach($mobApp);
        $fieldOfComputingAndTech->subjects()->attach($pm);

        $fieldOfComputing->subjects()->attach($cyber);
        $fieldOfComputing->subjects()->attach($networking);
        $fieldOfComputing->subjects()->attach($hardware);
        $fieldOfComputing->subjects()->attach($web);
        $fieldOfComputing->subjects()->attach($mobApp);
        $fieldOfComputing->subjects()->attach($pm);

        $fieldOfBusiness->subjects()->attach($strategy);
        $fieldOfBusiness->subjects()->attach($marketing);
        $fieldOfBusiness->subjects()->attach($entrepreneurship);
        $fieldOfBusiness->subjects()->attach($operations);
        $fieldOfBusiness->subjects()->attach($economics);
        $fieldOfBusiness->subjects()->attach($finance);
        $fieldOfBusiness->subjects()->attach($accounting);

        $fieldOfMarketing->subjects()->attach($strategy);
        $fieldOfMarketing->subjects()->attach($marketing);
        $fieldOfMarketing->subjects()->attach($entrepreneurship);
        $fieldOfMarketing->subjects()->attach($operations);
        $fieldOfMarketing->subjects()->attach($economics);
        $fieldOfMarketing->subjects()->attach($finance);
        $fieldOfMarketing->subjects()->attach($accounting);

        $fieldOfMBA->subjects()->attach($strategy);
        $fieldOfMBA->subjects()->attach($marketing);
        $fieldOfMBA->subjects()->attach($entrepreneurship);
        $fieldOfMBA->subjects()->attach($operations);
        $fieldOfMBA->subjects()->attach($economics);
        $fieldOfMBA->subjects()->attach($finance);
        $fieldOfMBA->subjects()->attach($accounting);
    }
}
