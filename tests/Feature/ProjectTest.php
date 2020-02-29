<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use WithFaker;
    /**
     * @test
     */
    public function a_supervisor_or_admin_can_create_a_task()
    {

        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
        ];

        $this->post('supervisor/tasks',$attributes);

        $this->assertDatabaseHas('task', $attributes);

   }
}
