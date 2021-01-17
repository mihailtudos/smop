<?php

namespace App\Http\Controllers\Supervisor;

use App\Email;
use App\EmailLog;
use App\Http\Controllers\Controller;
use App\Mail\SendEmailMailable;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use function foo\func;

class EmailsController extends Controller implements ShouldQueue
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $emails = auth()->user()->emails();
        return view('emails.index', compact('emails'));
    }

    public function create()
    {
        $students = auth()->user()->monitoredProjects->each(function($project, $key) {
            $emailList = $project->student->email;
        });
        $coordinator = User::with(['roles'=>function($q){$q->where('name', 'admin');}])->first();
        return view('supervisor.emails.create', compact(['coordinator', 'students']));
    }

    public function store(Request $request)
    {
     /*
      * 3 cases possible
      *
      * 1. if coordinatorTo and coordinatorCc == null then send messages only to students
      * 2. if coordinatorTo is set then send email only to coordinator
      * 3. if coordinatorCc is set then send email to students[] and coordinator included in cc
      *     for all cases include the auth()->user()->email in the sending list so the user gets a copy of the email!!!
     */

        $fromUser = Auth::user();

        if (!isset($request->coordinator)){
            $request->validate([
                'students'      => 'required|array',
                'students.*'    => 'required|email',
                'subject' => 'required|min:3',
                'message' => 'required|min:3',
            ]);
            $data = $request->all();
            foreach ($data['students'] as $email) {
                $toUser = User::whereEmail($email)->first();

                Mail::to($toUser)->send(new SendEmailMailable($fromUser, $toUser, $data['subject'], $data['message']));
                EmailLog::create(['from_user_id' => $fromUser->id, 'to_user_id' => $toUser->id]);
            }
        } else  if(!isset($request->students)){
            $request->validate([
                'coordinator' => 'required|email',
                'subject' => 'required|min:3',
                'message' => 'required|min:3',
            ]);
            $data = $request->all();
                $toUser = User::whereEmail($data['coordinator'])->first();

                Mail::to($toUser)->send(new SendEmailMailable($fromUser, $toUser, $data['subject'], $data['message']));
                EmailLog::create(['from_user_id' => $fromUser->id, 'to_user_id' => $toUser->id]);

        } else {
            $request->validate([
                'students' => 'required|array',
                'coordinator' => 'required|array',
                'subject' => 'required|min:3',
                'message' => 'required|min:3',
            ]);

            $data = $request->all();
            foreach ($data['coordinator'] as $email) {
                $toUser = User::whereEmail($email)->first();

                Mail::to($toUser)->send(new SendEmailMailable($fromUser, $toUser, $data['subject'], $data['message']));
                EmailLog::create(['from_user_id' => $fromUser->id, 'to_user_id' => $toUser->id]);
            }

            $toUser = User::whereEmail($request->coordinator)->first();
            Mail::to($toUser)->send(new SendEmailMailable($fromUser, $toUser, $data['subject'], $data['message']));
            EmailLog::create(['from_user_id' => $fromUser->id, 'to_user_id' => $toUser->id]);
        }



        return redirect()->route('supervisor.emails.index')->with('success','Email successfully sent!');
    }
}
