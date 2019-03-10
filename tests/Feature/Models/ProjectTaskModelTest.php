<?php

namespace Tests\Feature\Models;

use App\ProjectTask;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTaskModelTest extends TestCase
{
    use DatabaseMigrations;


    /** @test */
    public function check_if_relationship_for_author_exists()
    {
        $author = $this->employer();
        $task = factory(ProjectTask::class)->create([
            'user_id' => $author->id
        ]);
        $this->assertEquals($author->name, $task->author->name);
    }

    /** @test */
    public function check_if_relationship_for_users_exists()
    {
        $author = $this->employer();
        $task = factory(ProjectTask::class)->create([
            'user_id' => $author->id
        ]);
        $this->assertCount(0, $task->users);
    }

    /** @test */
    public function check_if_a_user_can_Be_added_to_a_task()
    {
        $author = $this->employer();
        $task = factory(ProjectTask::class)->create([
            'user_id' => $author->id
        ]);
        $user = $this->employee();
        $task->addUser($user);
        $this->assertCount(1, $task->users);
    }

    /** @test */
    public function check_if_a_user_can_Be_removed_from_a_task()
    {
        $author = $this->employer();
        $task = factory(ProjectTask::class)->create([
            'user_id' => $author->id
        ]);
        $user = $this->employee();
        $task->addUser($user);
        $task->removeUser($user);
        $this->assertCount(0, $task->users);
    }

}
