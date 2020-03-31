<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Notifications\NewTaskAdded;
use App\Project;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Project $project
     * @return void
     */
    public function store(Request $request, Project $project)
    {
        if (\auth()->user()->hasAnyRoles(['admin', 'supervisor']) and $project->ethicalForm->approved)
        {
            $data = $request->validate([
                'taskTitle'         => 'required|max:250',
                'taskDescription'   => 'required|max:250',
            ]);


            Task::create([
                'title'         =>   $data['taskTitle'],
                'description'   =>  $data['taskDescription'],
                'user_id'       => auth()->user()->id,
                'project_id'       => $project->id
            ]);

            $project->student->notify(new NewTaskAdded([
                'link' => $project->path(),
            ]));

            return redirect($project->path())->with('success', 'Task added!');
        }
        return abort(403, 'Unauthorised');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
