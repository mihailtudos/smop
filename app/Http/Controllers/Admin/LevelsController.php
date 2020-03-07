<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Level;
use Illuminate\Http\Request;

class LevelsController extends Controller
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
        $levels = Level::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.levels.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.levels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $result = Level::create($request->validate([
            'name' => 'required|unique:levels',
        ]));

        if($result){
            $request->session('success')->flash('success', "New study degree level has been successfully created!");
        }else{
            $request->session('error')->flash('error', 'There was an error, no new records generated!');
        }

        return redirect()->route('admin.levels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level)
    {
        return view('admin.levels.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Level $level)
    {
        $result = $level->update($request->validate([
            'name' => 'required|unique:levels',
        ]));

        if($result){
            $request->session('success')->flash('success', "Study degree level has been successfully updated!");
        }else{
            $request->session('error')->flash('error', 'There was an error, record unchanged!');
        }

        return redirect()->route('admin.levels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level, Request $request)
    {
        $result = $level->delete();
        if($result){
            $request->session('success')->flash('success', "Study degree level has been successfully deleted!");
        }else{
            $request->session('error')->flash('error', 'There was an error, record unchanged!');
        }

        return redirect()->route('admin.levels.index');
    }
}
