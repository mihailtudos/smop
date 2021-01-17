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


        $fieldOfComputingAndTech        = Field::where('name', 'BSc Computing and Technology')->first();
        $fieldOfComputing               = Field::where('name', 'BSc Computer Science')->first();
        $fieldOfBusiness                = Field::where('name', 'BSc Business')->first();
        $fieldOfMarketing               = Field::where('name', 'BSc Marketing')->first();

        $fieldOfMBA                     = Field::where('name', 'MSc MBA')->first();
        $fieldOfComputingAndTechMSc     = Field::where('name', 'MSc Computing and Technology')->first();
        $fieldOfComputingMSc            = Field::where('name', 'MSc Computer Science')->first();
        $fieldOfBusinessMSc             = Field::where('name', 'MSc Business')->first();
        $fieldOfMarketingMSc            = Field::where('name', 'MSc Marketing')->first();

        $fieldOfQA                      = Field::where('name', 'QA MBA')->first();
        $fieldOfComputingAndTechQA      = Field::where('name', 'QA Computing and Technology')->first();
        $fieldOfComputingQA             = Field::where('name', 'QA Computer Science')->first();
        $fieldOfBusinessQA              = Field::where('name', 'QA Business')->first();
        $fieldOfMarketingQA             = Field::where('name', 'QA Marketing')->first();

        $fieldOfComputingAndTech->subjects()->attach($cyber);
        $fieldOfComputingAndTech->subjects()->attach($networking);
        $fieldOfComputingAndTech->subjects()->attach($hardware);
        $fieldOfComputingAndTech->subjects()->attach($web);
        $fieldOfComputingAndTech->subjects()->attach($mobApp);
        $fieldOfComputingAndTech->subjects()->attach($pm);

        $fieldOfComputingAndTechMSc->subjects()->attach($cyber);
        $fieldOfComputingAndTechMSc->subjects()->attach($networking);
        $fieldOfComputingAndTechMSc->subjects()->attach($hardware);
        $fieldOfComputingAndTechMSc->subjects()->attach($web);
        $fieldOfComputingAndTechMSc->subjects()->attach($mobApp);
        $fieldOfComputingAndTechMSc->subjects()->attach($pm);

        $fieldOfComputingAndTechQA->subjects()->attach($cyber);
        $fieldOfComputingAndTechQA->subjects()->attach($networking);
        $fieldOfComputingAndTechQA->subjects()->attach($hardware);
        $fieldOfComputingAndTechQA->subjects()->attach($web);
        $fieldOfComputingAndTechQA->subjects()->attach($mobApp);
        $fieldOfComputingAndTechQA->subjects()->attach($pm);

        $fieldOfComputing->subjects()->attach($cyber);
        $fieldOfComputing->subjects()->attach($networking);
        $fieldOfComputing->subjects()->attach($hardware);
        $fieldOfComputing->subjects()->attach($web);
        $fieldOfComputing->subjects()->attach($mobApp);
        $fieldOfComputing->subjects()->attach($pm);

        $fieldOfComputingMSc->subjects()->attach($cyber);
        $fieldOfComputingMSc->subjects()->attach($networking);
        $fieldOfComputingMSc->subjects()->attach($hardware);
        $fieldOfComputingMSc->subjects()->attach($web);
        $fieldOfComputingMSc->subjects()->attach($mobApp);
        $fieldOfComputingMSc->subjects()->attach($pm);

        $fieldOfComputingQA->subjects()->attach($cyber);
        $fieldOfComputingQA->subjects()->attach($networking);
        $fieldOfComputingQA->subjects()->attach($hardware);
        $fieldOfComputingQA->subjects()->attach($web);
        $fieldOfComputingQA->subjects()->attach($mobApp);
        $fieldOfComputingQA->subjects()->attach($pm);

        $fieldOfBusiness->subjects()->attach($strategy);
        $fieldOfBusiness->subjects()->attach($marketing);
        $fieldOfBusiness->subjects()->attach($entrepreneurship);
        $fieldOfBusiness->subjects()->attach($operations);
        $fieldOfBusiness->subjects()->attach($economics);
        $fieldOfBusiness->subjects()->attach($finance);
        $fieldOfBusiness->subjects()->attach($accounting);

        $fieldOfBusinessMSc->subjects()->attach($strategy);
        $fieldOfBusinessMSc->subjects()->attach($marketing);
        $fieldOfBusinessMSc->subjects()->attach($entrepreneurship);
        $fieldOfBusinessMSc->subjects()->attach($operations);
        $fieldOfBusinessMSc->subjects()->attach($economics);
        $fieldOfBusinessMSc->subjects()->attach($finance);
        $fieldOfBusinessMSc->subjects()->attach($accounting);

        $fieldOfBusinessQA->subjects()->attach($strategy);
        $fieldOfBusinessQA->subjects()->attach($marketing);
        $fieldOfBusinessQA->subjects()->attach($entrepreneurship);
        $fieldOfBusinessQA->subjects()->attach($operations);
        $fieldOfBusinessQA->subjects()->attach($economics);
        $fieldOfBusinessQA->subjects()->attach($finance);
        $fieldOfBusinessQA->subjects()->attach($accounting);



        $fieldOfMarketing->subjects()->attach($strategy);
        $fieldOfMarketing->subjects()->attach($marketing);
        $fieldOfMarketing->subjects()->attach($entrepreneurship);
        $fieldOfMarketing->subjects()->attach($operations);
        $fieldOfMarketing->subjects()->attach($economics);
        $fieldOfMarketing->subjects()->attach($finance);
        $fieldOfMarketing->subjects()->attach($accounting);

        $fieldOfMarketingMSc->subjects()->attach($strategy);
        $fieldOfMarketingMSc->subjects()->attach($marketing);
        $fieldOfMarketingMSc->subjects()->attach($entrepreneurship);
        $fieldOfMarketingMSc->subjects()->attach($operations);
        $fieldOfMarketingMSc->subjects()->attach($economics);
        $fieldOfMarketingMSc->subjects()->attach($finance);
        $fieldOfMarketingMSc->subjects()->attach($accounting);

        $fieldOfMarketingQA->subjects()->attach($strategy);
        $fieldOfMarketingQA->subjects()->attach($marketing);
        $fieldOfMarketingQA->subjects()->attach($entrepreneurship);
        $fieldOfMarketingQA->subjects()->attach($operations);
        $fieldOfMarketingQA->subjects()->attach($economics);
        $fieldOfMarketingQA->subjects()->attach($finance);
        $fieldOfMarketingQA->subjects()->attach($accounting);

        $fieldOfMBA->subjects()->attach($strategy);
        $fieldOfMBA->subjects()->attach($marketing);
        $fieldOfMBA->subjects()->attach($entrepreneurship);
        $fieldOfMBA->subjects()->attach($operations);
        $fieldOfMBA->subjects()->attach($economics);
        $fieldOfMBA->subjects()->attach($finance);
        $fieldOfMBA->subjects()->attach($accounting);

        $fieldOfQA->subjects()->attach($strategy);
        $fieldOfQA->subjects()->attach($marketing);
        $fieldOfQA->subjects()->attach($entrepreneurship);
        $fieldOfQA->subjects()->attach($operations);
        $fieldOfQA->subjects()->attach($economics);
        $fieldOfQA->subjects()->attach($finance);
        $fieldOfQA->subjects()->attach($accounting);
    }
}
