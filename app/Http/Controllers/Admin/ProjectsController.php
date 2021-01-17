<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use App\ActivityTitle;
use App\Field;
use App\Http\Controllers\Controller;
use App\Notifications\ProjectAssigned;
use App\Project;
use App\Topic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gate;

class ProjectsController extends Controller
{
    //middleware checks if the user is auth to access the controller
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields = Field::all();

        return view('admin.projects.create', compact('fields'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'student_id' => ['required', 'unique:projects,student_id'],
            'title' => 'required|max:160',
            'studyField' => 'required',
            'supervisor' => 'required',
            'email'=>'exists:users,email',
        ]);

        $student = User::where('email', '=', $request->email)->first();
        $request['student_id'] = $student->id;


        $student = User::where('email', '=', $request->email)->first();

        $result = Project::create([
            'student_id' => $student->id,
            'supervisor_id' => $request->supervisor,
            'title' => $request->title,
        ]);

        if($result){
            $request->session('success')->flash('success', "Project has been created");
        }else{
            $request->session('error')->flash('error', 'There was an error in the process, try again');
        }

        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, User $user)
    {
       if(Gate::denies('manage-action')) {
           return redirect(route('admin.'));
       }

       $fields = Field::all();

       return view('admin.projects.edit')->with([
           'fields' => $fields,
           'project' => $project,
       ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        if(Gate::denies('manage-action')){
            return redirect(route('admin.'));
        }

        $request->validate(['email'=>'exists:users,email']);
        $student = User::where('email', '=', $request->email)->first();
        $request['student_id'] = $student->id;



        $result = $project->update($request->validate([
           'student_id' => ['required'],
           'title' => 'required|max:160'
       ]));

        if($result){
            $request->session('success')->flash('success', "Project has been updated");
        }else{
            $request->session('error')->flash('error', 'There was an error in the process, try again');
        }

        return redirect()->route('admin.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Request $request)
    {
        if(Gate::denies('manage-action')){
            return redirect(route('admin.'));
        }

        //deletes the user
        $result = $project->delete();

        if($result){
            $request->session('success')->flash('success', "Project has been updated");
        }else{
            $request->session('error')->flash('error', 'There was an error in the process');
        }

        //redirect to users page
        return redirect()->route('admin.projects.index');
    }

    public function fetch(Request $request)
    {
        //        $value =  $request->get('variable');//study value IT
        //        $dependent = $request->get('dependent');

        $field_name = $request->get('value'); //ex $field_name = 'IT';
        $role_name = $request->get('dependent'); // for example $role_name = 'supervisor'

        $supervisors = User::whereHas('roles', function ($query) use($role_name) {

            $query->where('name', $role_name);

        })->whereHas('fields', function ($query) use($field_name) {

            $query->where('name', $field_name);

        })->get();

//        $select = $request->get('select'); //first field


        $data = $supervisors;

        $output = '<option value=""> Select ' .ucfirst($role_name).'.</option>';
        foreach ($data as $row) {
            $managedProjects = User::find($row->id)->monitoredProjects()->get()->count();
            $output .= '<option value="'. $row->id.'">'.$row->name ."  ----- $managedProjects -----" .'</option>';
        }
        echo $output;

    }

    public function assign(Request $request, Topic $topic)
    {
        if(!auth()->user()->hasRole('admin') and $topic->project->count() == 0 and $topic->user->projects != null){
            return redirect()->back()->with('error', 'Unauthorised request!');
        }

        $data = $request->validate([
            'supervisor' => 'required'
        ]);

        $project = Project::create([
            'supervisor_id'     =>$data['supervisor'],
            'student_id'        =>$topic->user_id,
            'title'             =>$topic->title,
            'description'       =>$topic->description,
            'topic_id'          =>$topic->id
        ]);

        if(ActivityTitle::where('activity_title', 'assigned to project')->first() != null){

            $activity = ActivityTitle::where('activity_title', 'assigned to project')->first()->id;

            $project->student->notify(new ProjectAssigned([

                'title'     => $project->title,
                'link'      => $project->path(),

            ]));

            $project->supervisor->notify(new ProjectAssigned([

                'title'     => $project->title,
                'link'      => $project->path(),

            ]));

            $project->student->activities()->create(['activity_title_id' =>  $activity]);
            $project->supervisor->activities()->create(['activity_title_id' =>  $activity]);
        }



        return redirect()->back()->with('success', 'Supervisor assigned and new project created!');
    }

}
