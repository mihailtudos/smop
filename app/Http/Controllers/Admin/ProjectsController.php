<?php

namespace App\Http\Controllers\Admin;

use App\Field;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.projects.index');
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
            'email' => 'required|exists:users,email',
            'title' => 'required',
            'studyField' => 'required',
            'supervisor' => 'required'
        ]);

        $student = User::where('email', '=', $request->email)->first();


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
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
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
            $output .= '<option value="'. $row->id.'">'.$row->name.'</option>';
        }
        echo $output;

    }

}
