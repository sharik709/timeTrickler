<?php

namespace Tests\Feature\Controllers;

use App\Team;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamControllerTest extends TestCase
{
    use WithFaker, DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_a_user_can_create_a_team()
    {
        $employer = $this->employer();
        $employer->givePermissionTo('team:add');
        $team = [
            'title' => $this->faker->words(2, true),
            'description' => $this->faker->sentences(4, true)
        ];

        $this
            ->actingAs($employer)
            ->post('/employer/team', $team)
            ->assertRedirect('/employer/team');

        $this->assertDatabaseHas('teams', $team);

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_a_user_without_permission_cannot_create_a_team()
    {
        $employer = $this->employer();

        $team = [
            'title' => $this->faker->words(2, true),
            'description' => $this->faker->sentences(4, true)
        ];

        $this
            ->actingAs($employer)
            ->post('/employer/team', $team)
            ->assertStatus(403);

        $this->assertDatabaseMissing('teams', $team);
    }

    public function test_if_a_employer_delete_a_team()
    {
        $employer = $this->employer();
        $employer->givePermissionTo('team:delete');
        $team = factory(Team::class)->create([
            'user_id' => $employer->id
        ]);
        $this
            ->actingAs($employer)
            ->delete('/employer/team/'.$team->uuid)
            ->assertRedirect('/employer/team');

        $this->assertDatabaseMissing('teams', [
            'title' => $team->title,
            'id' => $team->id
        ]);
    }

    /** @test */
    public function check_if_a_employer_cannot_delete_team_if_he_is_not_the_creator()
    {
        $employer = $this->employer();
        $employer->givePermissionTo('team:delete');
        $team = factory(Team::class)->create();
        $this
            ->actingAs($employer)
            ->delete('/employer/team/'.$team->uuid)
            ->assertForbidden();

        $this->assertDatabaseHas('teams', [
            'title' => $team->title,
            'id' => $team->id
        ]);
    }

    /** @test */
    public function check_if_user_cannot_delete_team_if_doesnt_have_permission()
    {
        $employer = $this->employer();
        $employer->revokePermissionTo('team:delete');

        $team = factory(Team::class)->create([
            'user_id' => $employer->id
        ]);

        $this
            ->actingAs($employer)
            ->delete('/employer/team/'.$team->uuid)
            ->assertForbidden();

        $this->assertDatabaseHas('teams', [
            'title' => $team->title,
            'id' => $team->id
        ]);
    }

    /** @test */
    public function check_if_user_can_edit_a_team_title_and_Description()
    {
        $employer = $this->employer();
        $employer->givePermissionTo('team:update');

        $team = factory(Team::class)->create([
            'user_id' => $employer->id
        ]);

        $teamNew = [
            'title' => 'Hello, World',
            'description' => 'Wolrd, Hello is my world to know everything you got'
        ];

        $this
            ->actingAs($employer)
            ->patch('/employer/team/'.$team->uuid, $teamNew)
            ->assertRedirect('/employer/team');

        $this->assertDatabaseHas('teams', [
            'title' => $teamNew['title'],
            'description' => $teamNew['description']
        ]);
    }

    /** @test */
    public function test_if_only_a_owner_of_the_team_can_update_team()
    {
        $employer = $this->employer();
        $employer->revokePermissionTo('team:update');

        $team = factory(Team::class)->create();

        $teamNew = [
            'title' => 'Hello, World',
            'description' => 'Wolrd, Hello is my world to know everything you got'
        ];

        $this
            ->actingAs($employer)
            ->patch('/employer/team/'.$team->uuid, $teamNew)
            ->assertForbidden();

        $this->assertDatabaseHas('teams', [
            'title' => $team->title,
            'description' => $team->description
        ]);
    }

    /** @test */
    public function test_if_only_the_user_who_doesnt_have_permission_to_update_cant_update()
    {
        $employer = $this->employer();
        $employer->revokePermissionTo('team:update');

        $team = factory(Team::class)->create([
            'user_id' => $employer->id
        ]);

        $teamNew = [
            'title' => 'Hello, World',
            'description' => 'World, Hello is my world to know everything you got'
        ];

        $this
            ->actingAs($employer)
            ->patch('/employer/team/'.$team->uuid, $teamNew)
            ->assertForbidden();

        $this->assertDatabaseHas('teams', [
            'title' => $team->title,
            'description' => $team->description
        ]);
    }



}
