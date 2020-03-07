<?php

namespace App\Http\Controllers\Admin;

use App\Field;
use App\Http\Controllers\Controller;
use App\Level;
use Gate;
use Illuminate\Http\Request;

class FieldsController extends Controller
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
        $fields = Field::orderBy('created_at', 'desc')->paginate(7);
        return view('admin.fields.index', compact('fields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $levels = Level::all();
         if ($levels->count() !== 0){
             return view('admin.fields.create', compact('levels'));
         }else {
             $request->session('error')->flash('error', 'First you need to create a study grade (level) to be able to create study fields');
             return view('admin.dashboard');
         }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('admin')){
            return redirect(route('admin.users.index'));
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:fields'],
            'levels' => 'required',
        ]);

        $field = Field::create([
            'name' => $request->name,
        ]);

        $field->levels()->sync($request->levels);

        if($field){
            $request->session('success')->flash('success', "New study field was successfully created!");
        }else{
            $request->session('error')->flash('error', 'There was an error!');
        }

        return redirect()->route('admin.fields.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function edit(Field $field)
    {
        $levels = Level::all();

        return view('admin.fields.edit',compact(['field','levels']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Field $field)
    {
        $result = $field->update($request->validate([
                'name' => 'required|unique:fields,name'
            ])
        );

        if($result){
            $request->session('success')->flash('success', "Field $field->name has been updated!");
        }else{
            $request->session('error')->flash('error', 'There was an error!');
        }

        $field->levels()->sync($request->levels);

        return redirect()->route('admin.fields.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy(Field $field, Request $request)
    {
        $result = $field->delete();

        if($result){
            $request->session('success')->flash('success', "Study field {$field->name} was successfully deleted!");
        }else{
            $request->session('error')->flash('error', 'There was an error!');
        }

        return redirect()->route('admin.fields.index');
    }
}
