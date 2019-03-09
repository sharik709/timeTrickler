<?php

namespace Tests\Feature\Models;

use App\Team;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamModelTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function test_if_author_relationship_exists()
    {
        $team = factory(Team::class)->create();
        $this->assertInstanceOf(User::class, $team->author);
    }

    /** @test */
    public function test_if_users_relatioship_exists()
    {
        $team = factory(Team::class)->create();
        $this->assertEquals([], $team->users->toArray());
    }

    public function test_if_a_user_can_be_added_to_a_team()
    {
        $team = factory(Team::class)->create();
        $user = $this->employee();
        $team->addUser($user);
        $this->assertEquals($user->name, $team->users->first()->name);
    }

    public function test_if_a_user_can_be_removed_From_a_team()
    {
        $team = factory(Team::class)->create();
        $user = $this->employee();
        $team->addUser($user);
        $team->removeUser($user);
        $this->assertCount(0, $team->users);
    }

    public function test_if_hasReachedUsersLimit_return_false_when_limit_is_not_reached()
    {
        $team = factory(Team::class)->create();
        $team->addUser($this->employee());
        $team->addUser($this->employee());
        $this->assertFalse($team->hasReachedUsersLimit());
    }
}
