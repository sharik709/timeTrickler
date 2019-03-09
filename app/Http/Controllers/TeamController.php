<?php

namespace App\Http\Controllers;

use App\Http\Requests\Team\TeamDestroyRequest;
use App\Http\Requests\Team\TeamStoreRequest;
use App\Http\Requests\Team\TeamUpdateRequest;
use App\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamStoreRequest $request)
    {
        $team = Team::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id()
        ]);

        return redirect('/employer/team')->with('success', 'Team has been created.');
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
     * @param \Illuminate\Http\Request $request
     * @param Team $team
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(TeamUpdateRequest $request, Team $team)
    {
        $this->authorize('update', $team);
        $team->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect('/employer/team')->with('success', 'Team has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Team $team
     * @param TeamDestroyRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Team $team, TeamDestroyRequest $request)
    {
        $this->authorize('destroy', $team);
        $team->delete();
        return redirect('/employer/team')->with('success', 'Team has been deleted');
    }
}
