<?php

namespace App\Http\Controllers;

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
        if( $team->hasReachedUserLimit() ) {
            return back()
                        ->with('You can only add upto '.$team->users_limit .' Users');
        }
        $user = User::findByUuidOrFail($request->user);
        $team->addUser($user);
        return redirect('/employer/team/'.$team->uuid);
    }
}
