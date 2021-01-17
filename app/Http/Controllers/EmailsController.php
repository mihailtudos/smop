<?php

namespace App\Http\Controllers;

use App\Email;
use App\EmailLog;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = auth()->user()->emails();
        return view('emails.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->projects == null){
            $supervisor = null;
        }else {
            $supervisor = auth()->user()->projects->supervisor;
        }

        $coordinators = User::whereHas('roles', function($q){$q->where('name', 'admin');})->get();

        return view('emails.create', compact(['coordinators', 'supervisor']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'to'      => 'required|array',
            'to.*'    => 'required|email',
            'subject' => 'required|min:3',
            'message' => 'required|min:3',
        ]);

        $data   = $request->all();
        $fromUser = Auth::user();

        foreach ($data['to'] as $email) {
            $toUser = User::whereEmail($email)->first();

            Mail::to($toUser)->send(new SendEmailMailable($fromUser, $toUser, $data['subject'], $data['message']));
            EmailLog::create(['from_user_id' => $fromUser->id, 'to_user_id' => $toUser->id]);
        }


        return redirect()->back()->with('success', 'Email sent!');
    }
}
