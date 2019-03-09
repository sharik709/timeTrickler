<?php

use App\Project;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProjectUserControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_if_a_user_can_be_added_to_a_project()
    {
        $employer = $this->employer();
        $employer->givePermissionTo('project:user:add');
        $project = factory(Project::class)->create([
            'user_id' => $employer->id
        ]);
        $contributor = $this->employee();

        $this
            ->actingAs($employer)
            ->post('/employer/project/'.$project->uuid.'/user', [
                'user' => $contributor->uuid
            ])
            ->assertRedirect('/employer/project');
        $this->assertTrue($project->users->contains($contributor));
    }

    public function test_if_a_user_add_is_rejected_because_limit_reached_for_project()
    {
        $employer = $this->employer();
        $employer->givePermissionTo('project:user:add');
        $project = factory(Project::class)->create([
            'user_id' => $employer->id,
            'users_limit' => 3
        ]);

        $project->addUser($this->employee());
        $project->addUser($this->employee());
        $project->addUser($this->employee());

        $contributor = $this->employee();

        $this
            ->actingAs($employer)
            ->post('/employer/project/'.$project->uuid.'/user', [
                'user' => $contributor->uuid
            ])
            ->assertRedirect('/');
        $this->assertFalse($project->users->contains($contributor));
    }

    public function test_if_a_unauthenticated_author_cannot_add_a_user()
    {
        $employer = $this->employer();

        $project = factory(Project::class)->create([
            'user_id' => $employer->id
        ]);
        $contributor = $this->employee();

        $this
            ->post('/employer/project/'.$project->uuid.'/user', [
                'user' => $contributor->uuid
            ])
            ->assertRedirect('/login');
        $this->assertFalse($project->users->contains($contributor));
    }

    public function test_if_only_a_author_can_add_a_user_to_project()
    {
        $employer = $this->employer();
        $employer->givePermissionTo('project:user:add');
        $project = factory(Project::class)->create();
        $contributor = $this->employee();

        $this
            ->actingAs($employer)
            ->post('/employer/project/'.$project->uuid.'/user', [
                'user' => $contributor->uuid
            ])
            ->assertForbidden();
        $this->assertFalse($project->users->contains($contributor));
    }

    public function test_if_a_author_add_user_is_rejected_when_dont_have_permission_to_do_So()
    {
        $employer = $this->employer();
        $employer->revokePermissionTo('project:user:add');
        $project = factory(Project::class)->create();
        $contributor = $this->employee();

        $this
            ->actingAs($employer)
            ->post('/employer/project/'.$project->uuid.'/user', [
                'user' => $contributor->uuid
            ])
            ->assertForbidden();
        $this->assertFalse($project->users->contains($contributor));
    }

    /** @test */
    public function check_if_a_author_can_remove_a_user()
    {
        $employer = $this->employer();
        $employer->givePermissionTo('project:user:delete');
        $project = factory(Project::class)->create([
            'user_id' => $employer->id
        ]);
        $contributor = $this->employee();
        $project->addUser($contributor);

        $this
            ->actingAs($employer)
            ->delete('/employer/project/'.$project->uuid.'/user/'.$contributor->uuid)
            ->assertRedirect('/employer/project');
        $this->assertFalse($project->users->contains($contributor));
    }

    /** @test */
    public function check_if_only_a_author_can_remove_a_user()
    {
        $employer = $this->employer();
        $employer->givePermissionTo('project:user:delete');
        $project = factory(Project::class)->create();
        $contributor = $this->employee();
        $project->addUser($contributor);

        $this
            ->actingAs($employer)
            ->delete('/employer/project/'.$project->uuid.'/user/'.$contributor->uuid)
            ->assertForbidden();
        $this->assertTrue($project->users->contains($contributor));
    }

    /** @test */
    public function check_if_only_a_authenticated_author_can_remove_a_user()
    {
        $employer = $this->employer();
        $employer->givePermissionTo('project:user:delete');
        $project = factory(Project::class)->create();
        $contributor = $this->employee();
        $project->addUser($contributor);

        $this
            ->actingAs($employer)
            ->delete('/employer/project/'.$project->uuid.'/user/'.$contributor->uuid)
            ->assertForbidden();
        $this->assertTrue($project->users->contains($contributor));
    }

}
