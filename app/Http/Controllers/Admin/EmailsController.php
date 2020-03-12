<?php

namespace App\Http\Controllers\Admin;

use App\Field;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class EmailsController extends Controller
{
    public function __construct()
    {
        $student_role = 'student';
        $field_name = 'IT';
        $students = User::whereHas('roles', function ($query) use($student_role) {


            $query->where('name', $student_role);

        })->whereHas('fields', function ($query) use($field_name) {

            $query->where('name', $field_name);

        })->get();

        $this->middleware('auth');
    }

    public function fetch(Request $request)
    {
        $field_name = $request->get('value'); //ex $field_name = 'IT';
        $supervisor_role = $request->get('dependent'); // for example $role_name = 'supervisor'
        $student_role = $request->get('students'); // for example $role_name = 'supervisor'


        $students = User::whereHas('roles', function ($query) use($student_role) {

            $query->where('name', $student_role);

        })->whereHas('fields', function ($query) use($field_name) {

            $query->where('name', $field_name);

        })->get();

        $supervisor = User::whereHas('roles', function ($query) use($supervisor_role) {


            $query->where('name', $supervisor_role);

        })->whereHas('fields', function ($query) use($field_name) {

            $query->where('name', $field_name);

        })->get();


        $output['students'] ='';
        foreach ($students as $row) {
            $output['students'] .= '<option value="'. $row->email.'">'.$row->name  .'</option>';
        }

        $output['supervisors']='';
        foreach ($supervisor as $ro){
            $output['supervisors'] .= '<option value="'. $ro->email.'">'.$ro->name  .'</option>';
        }

        $output['supervisors'] .= '<option value="sfds">dsfds</option>';

        return $output;

    }

    public function create()
    {
        $fields = Field::all();
        return view('admin.emails.create', compact('fields'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

}
