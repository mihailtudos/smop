<?php

namespace App\Http\Controllers;

use App\ActivityTitle;
use App\Diary;
use App\Meeting;
use Illuminate\Http\Request;

class DiariesController extends Controller
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
        $records = auth()->user()->diaries;
        return view('diary.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->projects == null){
            $meetings = [];
        }else{
            $meetings = $user->projects->first()->meetings;
        }
        return view('diary.create', compact('meetings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->session()->flash('form', 'active');

        $data = $request->validate([
            'title' => 'required|min:5',
            'completed' => 'required|min:5',
            'notes' => 'required|min:5',
            'todo' => 'required|min:5',
            'meeting' => 'sometimes'
        ]);

        $result = auth()->user()->diaries()->create([

            'title'         => $data['title'],
            'completed'     => $data['completed'],
            'notes'         => $data['notes'],
            'todo'          => $data['todo'],
            'meeting_id'       => $data['meeting'],

        ]);

        if($result){
            $request->session('success')->flash('success', "A new diary record was created successfully!");
        }else{
            $request->session('error')->flash('error', 'There was an error');
        }

        $activity = ActivityTitle::where('activity_title', 'new diary record created')->first();

        if($activity !=null){
            auth()->user()->activities()->create([
                'activity_title_id' => $activity->id,
            ]);
        }

        return redirect()->back()->with('success', 'Diary record successfully created.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function show(Diary $diary)
    {
        $owner = $diary->user;
        $user = auth()->user();

        if ($user->hasRole('supervisor') or $owner->id == $user->id ){
            $supervisor = $user->supervisesTheStudent($owner);
            return view('common.diaries.show', compact('diary', 'owner'));
        }

        if ($user->hasRole('admin') or $owner->id == $user->id){
            return view('common.diaries.show', compact('diary', 'owner'));
        }

        return abort(403,'Unauthorised');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function edit(Diary $diary)
    {
        if (auth()->user()->id == $diary->user_id){
            if ($diary->meeting_id !=null){
                $meetings = $diary->meeting->project->meetings()->where('attended', 1)->get();
            } else {
                $meetings = [];
            }
            return view('diary.edit', compact('diary','meetings'));
        }
        return redirect()->route('home')->with('Not allowed to edit this record!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diary $diary)
    {
        if (auth()->user()->id == $diary->user_id){
            $data = $request->validate([
                'title'      =>  'required|min:5',
                'completed'  =>  'required|min:5',
                'todo'       =>  'required|min:5',
                'notes'      =>  'required|min:5',
                'meeting'    =>  'sometimes',
            ]);

            $diary->update($data);
            return redirect()->to($diary->path())->with('success', 'Diary record updated!');
        }
        return abort(403,'Unauthorised');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Diary $diary
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Diary $diary)
    {
        if (auth()->user()->id == $diary->user_id){
            $diary->delete();
            return redirect()->back()->with('success', 'Diary record delete!');
        }
        return redirect()->route('home')->with('Not allowed to delete this record!');
    }
}
