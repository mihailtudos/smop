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
        $levelBSc = Level::where('name', 'BSc')->first();
        $levelMSc = Level::where('name', 'MSc')->first();
        $levelQA = Level::where('name', 'QA partner')->first();

        $levelBSc->fields()->create(['name' => 'BSc Computing and Technology']);
        $levelBSc->fields()->create(['name' => 'BSc Computer Science']);
        $levelBSc->fields()->create(['name' => 'BSc Business']);
        $levelBSc->fields()->create(['name' => 'BSc Marketing']);
        $levelMSc->fields()->create(['name' => 'MSc MBA']);
        $levelMSc->fields()->create(['name' => 'MSc Computing and Technology']);
        $levelMSc->fields()->create(['name' => 'MSc Computer Science']);
        $levelMSc->fields()->create(['name' => 'MSc Business']);
        $levelMSc->fields()->create(['name' => 'MSc Marketing']);
        $levelQA->fields()->create(['name' => 'QA Computing and Technology']);
        $levelQA->fields()->create(['name' => 'QA Computer Science']);
        $levelQA->fields()->create(['name' => 'QA Business']);
        $levelQA->fields()->create(['name' => 'QA Marketing']);
        $levelQA->fields()->create(['name' => 'QA MBA']);

    }
}
