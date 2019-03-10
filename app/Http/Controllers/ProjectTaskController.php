<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectTask\ProjectTaskDestroyRequest;
use App\Http\Requests\ProjectTask\ProjectTaskStoreRequest;
use App\Project;
use App\ProjectTask;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
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
    public function store(ProjectTaskStoreRequest $request, Project $project)
    {
        $task = ProjectTask::create([
            'title' => $request->title,
            'description' => $request->description,
            'task_number' => time(),
            'due_date' => $request->due_date,
            'user_id' => auth()->id(),
            'project_id' => $project->id
        ]);

        return redirect('/employer/project/'.$project->uuid.'/task')
                            ->with('success', 'Task has been added.');
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
     * @param ProjectTaskDestroyRequest $request
     * @param Project $project
     * @param ProjectTask $task
     * @return void
     * @throws \Exception
     */
    public function destroy(ProjectTaskDestroyRequest $request, Project $project, ProjectTask $task)
    {
        $this->authorize('destroy', $task, $project);
        $task->delete();
        return redirect('/employer/project/'.$project->uuid.'/task')
                ->with('success', 'Task has been deleted');
    }
}
