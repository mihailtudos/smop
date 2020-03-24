<?php

namespace App\Http\Controllers\student;

use App\ActivityTitle;
use App\Diary;
use App\Http\Controllers\Controller;
use App\Meetings;
use Illuminate\Http\Request;

class DiariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = auth()->user()->diaries;
        return view('student.diary.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->projects == null){
            $meetings = [];
        }else{
            $meetings = auth()->user()->projects->meetings;
        }
        return view('student.diary.create', compact('meetings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        return redirect()->route('student.diaries.index');
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
            $meetings = [];
            if ($diary->user->projects()->first() != null){
                $meetings = $diary->user->projects()->first();
                return view('student.diary.edit', compact('meetings', 'diary'));
            }
            return view('student.diary.edit', compact('diary','meetings'));
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
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
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
