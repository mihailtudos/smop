<?php

namespace App\Http\Controllers\Admin;

use App\EmailLog;
use App\Field;
use App\Http\Controllers\Controller;
use App\Mail\SendEmailMailable;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailsController extends Controller implements ShouldQueue
{
    public function __construct()
    {
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


        return $output;

    }

    public function create()
    {
        $fields = Field::all();
        return view('admin.emails.create', compact('fields'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'student' => 'required_without:supervisor|array',
            'supervisor' => 'required_without:student|array',
            'student.*' => 'email',
            'supervisor.*' => 'email',
            'subject' => 'required|min:3',
            'message' => 'required|min:3',
        ]);

        $data = $request->all();
        $fromUser = Auth::user();

        $merged = '';
        if (isset($request->student) and isset($request->supervisor)){
            $merged = array_merge($request->student, $request->supervisor);
        } else if (isset($request->student) and !isset($request->supervisor)){
            $merged = $request->student;
        } else {
            $merged = $request->supervisor;
        }

        $result = $this->sendEmail($merged, $fromUser, $data['subject'], $data['message']);

        if($result){
            $request->session('success')->flash('success', "Email was successfully sent!");
        }else{
            $request->session('error')->flash('error', 'There was an error!');
        }

        return redirect()->route('supervisor.emails.index');
    }

    /**
     */
    public function sendEmail($emailList, $fromUser, $subject, $message)
    {
        foreach ($emailList as $email) {
            $toUser = User::whereEmail($email)->first();

            Mail::to($toUser)->send(new SendEmailMailable($fromUser, $toUser, $subject, $message));
            EmailLog::create(['from_user_id' => $fromUser->id, 'to_user_id' => $toUser->id]);
        }
        return true;
    }

}
