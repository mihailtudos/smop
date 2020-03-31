<?php

namespace App\Http\Controllers;

use App\Meeting;
use App\Project;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        if ($project->student->id === auth()->user()->id or $project->supervisor->id === auth()->user()->id or auth()->user()->hasRole('admin')){
            $form = $project->student->ethicalForm;
            $tasks = $project->tasks()->orderBy('created_at','desc')->get();
            $incompletedTasks = $project->tasks()->where('completed', 0)->get();
            $completedTasks = $project->tasks()->where('completed', 1)->get();
            $meetings = Meeting::where('project_id', $project->id)->orderBy('created_at', 'desc')->get();
            $completedMeetings = Meeting::where('project_id', $project->id)->where('attended','!=', null)->orderBy('updated_at', 'desc')->get();
            $cancelledMeetings = Meeting::onlyTrashed()->where('project_id', $project->id)->orderBy('created_at', 'desc')->get();


            return view('projects.show', compact('project', 'form', 'tasks', 'meetings', 'completedMeetings', 'incompletedTasks', 'completedTasks', 'cancelledMeetings'));
        }else {
            return redirect()->route('home');
        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
