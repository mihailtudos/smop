<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Subject;
use Gate;
use Illuminate\Http\Request;

class ProfilesController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        if (auth()->user()->checkProfile($profile->id)){
            return view('profiles.show', compact('profile'));
        }

        return redirect()->back()->with('error', 'Access denied!!!');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }

    public function addsubject(Request $request, Profile $profile)
    {
        if(Gate::denies('supervise')){
            return redirect()->route('home')->with('error', 'Unauthorised action!');
        }

        if ($request->availability != null){

            $data = $request->validate([
                'availability' => 'required'
            ]);

            $currentAvailability = $profile->availability;

            if ($currentAvailability + $data['availability'] < 0){
                return redirect()->back()->with('error', 'Negative value given!!!');
            }
            $result = $currentAvailability + $data['availability'] ;
            $profile->update([
               'availability' => $result
            ]);

            return redirect()->back()->with('success', 'Availability modified!');
        }

        $data = $request->validate([
           'subject' => 'required'
        ]);

        $profile->subjects()->attach($data['subject']);
        return redirect()->back()->with('success', 'Subject ability attached!');
    }

    public function detachSubject(Request $request, Profile $profile)
    {
        if (Gate::denies('supervise')) {
            return redirect()->route('home')->with('error', 'Unauthorised action!');
        }

        foreach ($request->except('_token') as $key => $part) {
            $subject = $key;
        }

        $profile->subjects()->detach($key);

        return redirect()->back()->with('success', 'Subject removed');
    }
}
