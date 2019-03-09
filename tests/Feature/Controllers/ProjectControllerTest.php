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
        $employer->givePermissionTo('project:view');
        $project = factory(Project::class)->create([
            'user_id' => $employer->id
        ]);

        $this
            ->actingAs($employer)
            ->get('/employer/project/'.$project->uuid)
            ->assertSee($project->title);
    }

    /** @test */
    public function test_if_only_a_owner_can_view_the_project()
    {
        $employer = $this->employer();
        $project = factory(Project::class)->create();

        $this
            ->actingAs($employer)
            ->get('/employer/project/'.$project->uuid)
            ->assertStatus(403);
    }

    public function test_if_only_a_owner_can_view_the_project_when_authenticated()
    {
        $employer = $this->employer();
        $project = factory(Project::class)->create([
            'user_id' => $employer->id
        ]);

        $this
            ->get('/employer/project/'.$project->uuid)
            ->assertStatus(302)
            ->assertSee('login');
    }

    public function test_if_a_employer_can_create_a_project()
    {
        $employer = $this->employer();
        $employer->givePermissionTo('project:add');
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

    public function test_if_only_a_employer_can_create_the_project_when_have_the_permission()
    {
        $employer = $this->employer();

        $employer->revokePermissionTo('project:add');

        $project = [
            'title' => 'Save the world',
            'description' => 'Saving the world is a great things'
        ];

        $this
            ->actingAs($employer, 'api')
            ->post('/employer/project', $project)
            ->assertStatus(403);

        $this->assertDatabaseMissing('projects', $project);
    }

    public function test_if_a_employer_can_view_all_his_projects()
    {
        $employer = $this->employer();
        $projects = factory(Project::class, 10)->create([
            'user_id' => $employer->id
        ]);

        factory(Project::class, 2)->create();

        $this
            ->actingAs($employer)
            ->get('/employer/project')
            ->assertOk()
            ->assertSee($projects->first()->title);
    }

    public function test_if_unauthenticated_employer_cannot_view_all_projects()
    {
        $employer = $this->employer();
        factory(Project::class, 10)->create([
            'user_id' => $employer->id
        ]);

        $this
            ->get('/employer/project')
            ->assertRedirect('/login');
    }





}
