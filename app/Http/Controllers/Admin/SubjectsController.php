<?php

namespace App\Http\Controllers\Admin;

use App\Field;
use App\Http\Controllers\Controller;
use App\Level;
use App\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
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
        $subjects = Subject::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $degrees = Level::all();
        return view('admin.subjects.create', compact('degrees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { $result = '';
        $data = $request->validate([
           'degree' => 'required',
           'degreeFields' => 'required',
           'name' => ['required', 'string', 'max:255'],
        ]);

       if(!Subject::where('name', trim($data['name']))->first()){
           $result = $subject = Subject::create([
               'name' => $data['name'],
           ]);
           $subject->fields()->sync($request->degreeFields);
       } else {
           $result =  $subject = Subject::where('name', trim($data['name']))->first();
           $subject->fields()->attach(Subject::whereName($data['name'])->pluck('id'));
       }

        if($result){
            $request->session('success')->flash('success', "Subject was successfully created!");
        }else{
            $request->session('error')->flash('error', 'There was an error!');
        }

        return redirect()->route('admin.subjects.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {

        $fields = Field::all();

        return view('admin.subjects.edit', compact('subject', 'fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $data = $request->validate([
            'name' => 'required|min:2',
            'fields' => 'required'
        ]);

        $subject->update([
            'name' => $data['name']
        ]);

        $subject->fields()->sync($data['fields']);

        return redirect()->route('admin.subjects.index')->with('success', 'The field was successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Subject $subject
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Subject $subject)
    {
        //detaches all subjects from their fields
        $subject->fields()->detach();

        //deletes the subject
        $subject->delete();

        //redirect to users page
        return redirect()->route('admin.subjects.index')->with('success', 'The field was successfully deleted!');
    }
}
