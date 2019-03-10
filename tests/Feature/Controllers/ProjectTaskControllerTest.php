<?php

namespace Tests\Feature\Controllers;

use App\Project;
use App\ProjectTask;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTaskControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_if_a_task_can_be_added_for_a_project()
    {
        $employer = $this->employer();
        $employer->givePermissionTo('task:add');
        $project = factory(Project::class)->create([
            'user_id' => $employer->id
        ]);
        $task = factory(ProjectTask::class)->raw();
        $this
            ->actingAs($employer)
            ->post('/employer/project/'.$project->uuid.'/task', $task)
            ->assertRedirect('/employer/project/'.$project->uuid.'/task');
        $this->assertDatabaseHas('project_tasks', [
            'title' => $task['title'],
            'description' => $task['description']
        ]);
    }

    public function test_if_only_person_who_has_permission_to_add_task_to_a_project()
    {
        $employer = $this->employer();
        $employer->revokepermissionto('task:add');
        $project = factory(project::class)->create([
            'user_id' => $employer->id
        ]);
        $task = factory(projecttask::class)->raw();
        $this
            ->actingas($employer)
            ->post('/employer/project/'.$project->uuid.'/task', $task)
            ->assertforbidden();
        $this->assertdatabasemissing('project_tasks', [
            'title' => $task['title'],
            'description' => $task['description']
        ]);
    }

    public function test_if_a_task_can_be_deleted()
    {
        $employer = $this->employer();
        $employer->givePermissionTo('task:delete');
        $project = factory(Project::class)->create([
            'user_id' => $employer->id
        ]);
        $task = factory(ProjectTask::class)->create([
            'project_id' => $project->id,
            'user_id' => $employer->id
        ]);
        $this
            ->actingAs($employer)
            ->delete('/employer/project/'.$project->uuid.'/task/'.$task->uuid)
            ->assertRedirect('/employer/project/'.$project->uuid.'/task');

        $this->assertDatabaseMissing('project_tasks', [
            'title' => $task['title'],
            'description' => $task['description']
        ]);
    }

    public function test_if_a_task_cannot_be_deleted_if_permission_is_not_given()
    {
        $employer = $this->employer();
        $employer->revokePermissionTo('task:delete');
        $project = factory(Project::class)->create([
            'user_id' => $employer->id
        ]);
        $task = factory(ProjectTask::class)->create([
            'project_id' => $project->id,
            'user_id' => $employer->id
        ]);
        $this
            ->actingAs($employer)
            ->delete('/employer/project/'.$project->uuid.'/task/'.$task->uuid)
            ->assertForbidden();

        $this->assertDatabaseHas('project_tasks', [
            'title' => $task['title'],
            'description' => $task['description']
        ]);
    }

    public function test_if_project_owner_can_delete_that_task()
    {
        $employer = $this->employer();
        $employer->givePermissionTo('task:delete');
        $project = factory(Project::class)->create([
            'user_id' => $employer->id
        ]);
        $task = factory(ProjectTask::class)->create();
        $this
            ->actingAs($employer)
            ->delete('/employer/project/'.$project->uuid.'/task/'.$task->uuid)
            ->assertForbidden();

        $this->assertDatabaseHas('project_tasks', [
            'title' => $task['title'],
            'description' => $task['description']
        ]);
    }

}
