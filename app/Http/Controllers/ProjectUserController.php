<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectUser\ProjectUserDestroyRequest;
use App\Http\Requests\ProjectUser\ProjectUserStoreRequest;
use App\Project;
use App\User;
use Illuminate\Http\Request;

class ProjectUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Project $project
     * @param Request $request
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Project $project, ProjectUserStoreRequest $request)
    {
        $this->authorize('isAuthor', $project);
        if( $project->hasReachedUsersLimit() ) {
            return back()->with('danger', 'Limit Reached. You can only add upto ' . $project->users_limit);
        }
        $user = User::findByUuidOrFail($request->user);

        $project->addUser($user);

        return redirect('/employer/project')->with('success', 'User has been successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @param User $user
     * @param ProjectUserDestroyRequest $request
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Project $project, User $user, ProjectUserDestroyRequest $request)
    {
        $this->authorize('isAuthor', $project);
        $project->removeUser($user);
        return redirect('/employer/project')->with('success', 'User has been removed.');
    }
}
