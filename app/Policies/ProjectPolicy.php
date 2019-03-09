<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
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
     * @param $user
     * @param $project
     * @return bool
     */
    public function show($user, $project)
    {
        if( $user->id == $project->user_id ) {
            return true;
        }
        return false;
    }

}
