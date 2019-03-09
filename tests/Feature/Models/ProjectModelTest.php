<?php


use App\Project;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProjectModelTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function check_if_relationship_with_author_exists()
    {
        $user = $this->employer();
        $project = factory(Project::class)->create([
            'user_id' => $user->id
        ]);
        $this->assertEquals($user->name, $project->author->name);
        $this->assertInstanceOf(Project::class, $project);
    }

    /** @test */
    public function check_if_hasReachedUsersLimit_returns_true_when_limit_is_reached()
    {
        $user = $this->employer();

        $project = factory(Project::class)->create([
            'user_id' => $user
        ]);

        $project->users()->attach($this->employee());
        $project->users()->attach($this->employee());
        $project->users()->attach($this->employee());

        $this->assertTrue($project->hasReachedUsersLimit());
    }

    /** @test */
    public function check_if_hasReachedUsersLimit_returns_false_when_limit_is_not_reached()
    {
        $user = $this->employer();

        $project = factory(Project::class)->create([
            'user_id' => $user,
            'users_limit' => 3
        ]);

        $project->users()->attach($this->employee());
        $project->users()->attach($this->employee());

        $this->assertFalse($project->hasReachedUsersLimit());
    }

    /** @test */
    public function check_if_relationship_with_users_exists()
    {
        $user = $this->employer();
        $project = factory(Project::class)->create([
            'user_id' => $user->id
        ]);
        $project->users()->attach($this->employee());
        $this->assertInstanceOf(User::class, $project->users->first());
    }

    public function test_if_author_can_add_a_user_to_the_project()
    {
        $author = $this->employer();
        $project = factory(Project::class)->create([
            'user_id' => $author->id
        ]);
        $user = $this->employee();

        $project->addUser($user);

        $this->assertTrue($project->users->contains($user));
    }

    /** @test */
    public function check_if_author_can_remove_a_user()
    {
        $author = $this->employer();
        $project = factory(Project::class)->create([
            'user_id' => $author->id
        ]);
        $user = $this->employee();
        $project->addUser($user);

        $project->removeUser($user);

        $this->assertFalse($project->users->contains($user));
    }

}
