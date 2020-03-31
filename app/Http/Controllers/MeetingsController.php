<?php

namespace App\Http\Controllers;

use App\Meeting;
use App\Notifications\MeetingSet;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MeetingsController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Project $project)
    {

        $request->session()->flash('meeting', 'active');

        $data = $request->validate([
            'subject'       => 'required',
            'meeting_form'  => 'required',
            'location'      => 'required_if:meeting_form,==,other|required_if:meeting_form,==,face-to-face',
            'date'          => 'required|date_format:Y-m-d H:i|after:tomorrow',
            'meeting_notes' => 'required',
        ]);

        $user = auth()->user();

        $meeting = auth()->user()->meetings()->create([

            'subject'       => $data['subject'],
            'meeting_notes' => $data['meeting_notes'],
            'meeting_form'  => $data['meeting_form'],
            'location'      => $data['location'],
            'date'          => $data['date'],
            'project_id'    => $project->id,

        ]);


        $project->student->notify(new MeetingSet([
            'date'          => $data['date'],
            'meeting_form'  => $data['meeting_form'],
            'link'          => $project->path(),
        ]));

        return redirect()->back()->with('success', 'Proposed meeting sent! The meeting will appear under "scheduled meetings".');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show(Meeting $meeting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $meeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meeting $meeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
        //
    }

    public function attendance(Request $request, Meeting $meeting)
    {
            $request->session()->flash('attendance', 'active');

        $data = $request->validate([
           'attended' => 'required'
        ]);

        $meeting->update([
            'attended' => $data['attended']
        ]);

        return redirect()->back()->with('success', 'Attendance recorded!');
    }

    public function confirmation(Request $request, Meeting $meeting)
    {
        $request->session()->flash('upcoming', 'active');

        $meeting->update([
            'accepted' => 1
        ]);

        return redirect()->back()->with('success', 'Confirmation registered');
    }
}
