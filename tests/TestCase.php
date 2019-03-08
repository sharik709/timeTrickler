<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed --class="SetupUserRolesSeeder"');
        $this->withExceptionHandling();
    }

    /**
     * @param array $attributes
     * @param null $times
     * @return mixed
     */
    public function employer($attributes = [], $times = null)
    {
        $user = $this->user($attributes, $times);
        $user->assignRole('employer');
        return $user;
    }

    /**
     * @param array $attributes
     * @param null $times
     * @return mixed
     */
    public function employee($attributes = [], $times = null)
    {
        $user = $this->user($attributes, $times);
        $user->assignRole('employee');
        return $user;
    }

    /**
     * @param array $attributes
     * @param null $times
     * @return mixed
     */
    public function user($attributes = [], $times = null)
    {
        return factory(User::class, $times)->create($attributes);
    }


}
