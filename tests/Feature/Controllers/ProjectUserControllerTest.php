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


}
