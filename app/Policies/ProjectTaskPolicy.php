<?php

namespace App\Policies;

use App\Project;
use App\ProjectTask;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectTaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param ProjectTask $task
     * @param Project $project
     * @return bool
     */
    public function destroy(User $user, ProjectTask $task)
    {
        return $user->id == $task->user_id;
    }
}
