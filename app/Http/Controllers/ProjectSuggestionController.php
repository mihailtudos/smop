<?php

namespace App\Http\Controllers;

use App\Field;
use App\ProjectSuggestion;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProjectSuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suggestions = ProjectSuggestion::latest();
        return view('common.projectSuggestions.index', compact('suggestions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $fields = Field::all();
        return view('common.projectSuggestions.create',compact('fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request)
    {

        $data = $request->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:15',
            'body' => 'required|min:100',
            'field' => 'required',
            'image' => 'image|sometimes|mimes:jpeg,bmp,png,jpg|max:2500',
        ]);

        if ($request->has('image')) {
            $imagePath = $request['image']->store('uploads', 'public');
        } else {

            $imagePath = 'uploads/banner.jpg';
        }

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        $suggestion = auth()->user()->suggestions()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'body' => $data['body'],
            'field' => $data['field'],
            'image' => $imagePath,
        ]);

        if($suggestion){
            $request->session('success')->flash('success', "New suggestion has been successfully published!");
        }else{
            $request->session('error')->flash('error', 'There was an error!');
        }

        return redirect('/suggestions');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
