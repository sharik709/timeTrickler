<?php

use App\Project;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function test_if_a_employer_can_view_a_project()
    {
        $employer = $this->employer();
        $project = factory(Project::class)->create([
            'user_id' => $employer->id
        ]);

        $this
            ->actingAs($employer)
            ->get('/employer/project/'.$project->uuid)
            ->assertSee($project->title);
    }

    public function test_if_a_employer_can_create_a_project()
    {
        $employer = $this->employer();

        $project = [
            'title' => 'Save the world',
            'description' => 'Saving the world is a great things'
        ];

        $this
            ->actingAs($employer, 'api')
            ->post('/employer/project', $project)
            ->assertStatus(302);

        $this->assertDatabaseHas('projects', $project);

    }





}
