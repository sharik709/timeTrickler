<?php

namespace Tests\Feature\Controllers;

use App\Team;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamUserControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_if_a_user_can_be_added_to_a_team()
    {
        $employer = $this->employer();
        $team = factory(Team::class)->create(['user_id' => $employer->id]);
        $user = $this->employee();
        $this
            ->actingAs($employer)
            ->post('/employer/team/'.$team->uuid.'/user', [
                'user' => $user->uuid
            ])
            ->assertRedirect('/employer/team/'.$team->uuid);
        $this->assertTrue($team->users->contains($user));
    }

    public function test_if_a_user_cannot_be_added_to_a_team_when_team_is_full()
    {
        $employer = $this->employer();
        $team = factory(Team::class)->create(['user_id' => $employer->id]);
        $team->addUser($this->employee());
        $team->addUser($this->employee());
        $team->addUser($this->employee());

        $user = $this->employee();
        $this
            ->actingAs($employer)
            ->post('/employer/team/'.$team->uuid.'/user', [
                'user' => $user->uuid
            ])
            ->assertRedirect('/');
        $this->assertFalse($team->users->contains($user));
    }

    /** @test */
    public function check_if_user_can_be_removed_from_a_team()
    {
        $employer = $this->employer();
        $employer->givePermissionTo('team:user:delete');
        $team = factory(Team::class)->create(['user_id' => $employer->id]);
        $user = $this->employee();
        $team->addUser($user);
        $team->addUser($this->employee());
        $team->addUser($this->employee());

        $this
            ->actingAs($employer)
            ->delete('/employer/team/'.$team->uuid.'/user/'.$user->uuid)
            ->assertRedirect('/employer/team/'.$team->uuid);
        $this->assertFalse($team->users->contains($user));
    }

    public function test_if_only_who_has_permission_can_remove_user_from_team()
    {
        $employer = $this->employer();
        $team = factory(Team::class)->create(['user_id' => $employer->id]);
        $user = $this->employee();
        $team->addUser($user);
        $team->addUser($this->employee());
        $team->addUser($this->employee());

        $this
            ->actingAs($employer)
            ->delete('/employer/team/'.$team->uuid.'/user/'.$user->uuid)
            ->assertForbidden();
        $this->assertTrue($team->users->contains($user));
    }

    public function test_if_only_who_has_created_team_can_remove_user_from_team()
    {
        $employer = $this->employer();
        $employer->givePermissionTo('team:user:delete');
        $team = factory(Team::class)->create();
        $user = $this->employee();
        $team->addUser($user);
        $team->addUser($this->employee());
        $team->addUser($this->employee());

        $response = $this
            ->actingAs($employer)
            ->delete('/employer/team/'.$team->uuid.'/user/'.$user->uuid)
            ->assertForbidden();
        $this->assertTrue($team->users->contains($user));
    }
}
