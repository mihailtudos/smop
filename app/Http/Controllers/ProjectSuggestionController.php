<?php

namespace App\Http\Controllers;

use App\Field;
use App\Level;
use App\Notifications\ProjectSuggestionRequested;
use App\Subject;
use App\User;
use Gate;
use App\ProjectSuggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProjectSuggestionController extends Controller
{
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
        if (auth()->user()->hasRole('admin')){
            $suggestions = ProjectSuggestion::orderBy('created_at', 'desc')->paginate(7);
        } else {
            $suggestions = auth()->user()->suggestions()->orderBy('created_at', 'desc')->paginate(7);
        }

        return view('common.projectSuggestions.index', compact('suggestions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields = Field::all();
        $subjects = Subject::all();
        return view('common.projectSuggestions.create',compact('fields', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request)
    {
        //input validation, if the input doesn't pass the validation an error will be returned
        //validated input is stored in a variable ($data) therefore, only the validated input can used further
        $data = $request->validate([
            'title'         => 'required|min:25',
            'description'   => 'required|min:150|max:1500',
            'methodology'   => 'required|min:150|max:1500',
            'deliverables'  => 'required|min:150|max:1500',
            'body'          => 'required|min:150|max:1500',
            'image'         => 'image|sometimes|mimes:jpeg,bmp,png,jpg|max:2500',
            'fields'        => 'required',
            'subjects'      => 'required',
        ]);


        if ($request->has('image')) {
            $imagePath = $request['image']->store('uploads', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(2200, 1000);
            $image->save();
        } else {
            $imagePath = 'uploads/banner.jpg';
        }

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(2200, 1000);
        $image->save();

        //using prepared statements to create a new record using only data ($data) that passed the validation
        $suggestion = auth()->user()->suggestions()->create([
            'title'         => $data['title'],
            'description'   => $data['description'],
            'methodology'   => $data['methodology'],
            'deliverables'  => $data['deliverables'],
            'body'          => $data['body'],
            'image'         => $imagePath,
        ]);

        $suggestion->fields()->sync($data['fields']);
        $suggestion->subjects()->sync($data['subjects']);

        if($suggestion){
            $request->session('success')->flash('success', "New project suggestion has been successfully published!");
        }else{
            $request->session('error')->flash('error', 'There was an error!');
        }

        return redirect('/suggestions');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectSuggestion $suggestion)
    {
        return view('common.projectSuggestions.show', compact('suggestion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProjectSuggestion $suggestion
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectSuggestion $suggestion)
    {
        if (auth()->user()->hasRole('admin') or $suggestion->user_id == auth()->user()->id){
            $subjects = Subject::all();
            $fields = Field::all();
            return view('common.projectSuggestions.edit', compact('suggestion', 'subjects', 'fields'));
        } else {
            return redirect()->back()->with('error', 'You are not allowed to edit this item');
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ProjectSuggestion $suggestion
     * @return void
     */
    public function update(Request $request, ProjectSuggestion $suggestion)
    {

        $data = $request->validate([
            'title'         => 'required|min:25',
            'description'   => 'required|min:15|max:1500',
            'methodology'   => 'required|min:15|max:1500',
            'deliverables'  => 'required|min:15|max:1500',
            'body'          => 'required|min:15|max:1500',
            'image'         => 'image|sometimes|mimes:jpeg,bmp,png,jpg|max:2500',
            'fields'        => 'required',
            'subjects'      => 'required',
        ]);

        if ($request->has('image')) {
            if ($suggestion->image != 'uploads/banner.jpg' and Storage::exists( 'public/'. $suggestion->image)) {
                Storage::delete('public/' .$suggestion->image);
            }
            $imagePath = $request['image']->store('uploads', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(2200, 1000);
            $image->save();
        } else {
            $imagePath = $suggestion->image;
        }

        $result = $suggestion->update([
            'title'         => $data['title'],
            'description'   => $data['description'],
            'methodology'   => $data['methodology'],
            'deliverables'  => $data['deliverables'],
            'body'          => $data['body'],
            'image'         => $imagePath,
        ]);

        $suggestion->fields()->sync($data['fields']);
        $suggestion->subjects()->sync($data['subjects']);

        if($result){
            $request->session('success')->flash('success', "The project suggestion has been successfully updated!");
        }else{
            $request->session('error')->flash('error', 'There was an error!');
        }

        return redirect('/suggestions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProjectSuggestion $suggestion
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(ProjectSuggestion $suggestion, Request $request)
    {
        //delete stored image if post image is not the default img
        if ($suggestion->image != 'uploads/banner.jpg' and Storage::exists( 'public/'. $suggestion->image)) {
            Storage::delete('public/' .$suggestion->image);
        }
        //deletes the post
        $response = $suggestion->delete();

        //return flash message
        if($response){
            $request->session('success')->flash('success', "The project suggestion has been deleted successfully!");
        }else{
            $request->session('error')->flash('error', 'There was an error!');
        }
        //redirect to index posts page
        return redirect()->route('suggestions.index');
    }

    public function fetch(Request $request)
    {
        $fieldIds = $request->get('fieldIds'); //ex $field_name = 'IT';
        $role_name = $request->get('dependent'); // for example $role_name = 'supervisor'


        $output = '<option value=""> Select ' .ucfirst($role_name).'.</option>';
        foreach ($fieldIds as $row){
            echo $role_name = Field::find($row)->subjects();
        }

        foreach ($role_name as $role){

            $output .= '<option value=""> Select ' .ucfirst($role->name).'.</option>';
        }

//        $data = Level::find($fieldIds)->first()->fields();


//        foreach ($data as $row) {
//            $output .= '<option value="'. $row->id.'">'.$row->name .'</option>';
//        }
        echo $output;
    }

    public function request(ProjectSuggestion $suggestion)
    {
        $user = User::with(['roles' => function($q){
            $q->where('name', 'admin');
        }])->first();

        $user->notify(new ProjectSuggestionRequested([

            'project'   => $suggestion->title,
            'name'      => auth()->user()->name,

            ]));

        return redirect()->back()->with('success', 'Coordination was notified about your request!');
    }
}
