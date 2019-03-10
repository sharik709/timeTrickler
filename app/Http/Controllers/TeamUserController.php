<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamUser\TeamUserDestroyRequest;
use App\Team;
use App\User;
use Illuminate\Http\Request;

class TeamUserController extends Controller
{
    /**
     * @param Team $team
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Team $team, Request $request)
    {
        if( $team->hasReachedUsersLimit() ) {
            return back()
                        ->with('You can only add upto '.$team->users_limit .' Users');
        }
        $user = User::findByUuidOrFail($request->user);
        $team->addUser($user);
        return redirect('/employer/team/'.$team->uuid);
    }

    /**
     * @param Request $request
     * @param Team $team
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(TeamUserDestroyRequest $request, Team $team, User $user)
    {
        $this->authorize('destroy', $team);
        $team->removeUser($user);
        return redirect('/employer/team/'.$team->uuid);
    }
}
