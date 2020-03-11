<?php

namespace App\Http\Controllers\Supervisor;

use App\Email;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use function foo\func;

class EmailsController extends Controller
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
        $emails = Email::where('user_id', auth()->user())->paginate(7);
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
        dd($request->all());
    }
}
