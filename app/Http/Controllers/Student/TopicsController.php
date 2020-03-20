<?php

namespace App\Http\Controllers\Student;

use App\Field;
use App\Http\Controllers\Controller;
use App\Level;
use App\Subject;
use App\Topic;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = auth()->user()->topics;
        return view('student.topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (auth()->user()->fields->first()){
            $subjects = auth()->user()->fields->first()->subjects;
        } else {
            $subjects = Subject::all();
        }

        return view('student.topics.create', compact('subjects'));
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
            'title'         => 'required|min:15',
            'description'   => 'required|min:150|max:1500',
            'methodology'   => 'required|min:150|max:1500',
            'deliverables'  => 'required|min:150|max:1500',
            'body'          => 'required|min:100|max:1500',
            'subject'       =>  'required',
            'image'         => 'image|sometimes|mimes:jpeg,bmp,png,jpg|max:2500',
        ]);

        if ($request->has('image')) {
            $imagePath = $request['image']->store('uploads', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(2200, 1000);
            $image->save();
        } else {
            $imagePath = 'uploads/banner.jpg';
        }


        if (auth()->user()->levels->first()==null){
            return redirect()->route('home')->with('error', 'Contact your admin to assign you a study field');
        } else {
            $degree = auth()->user()->levels->first();
        }

        if (auth()->user()->fields->first()){
            $fieldOfStudy = auth()->user()->fields->first();
        } else {
            $fieldOfStudy = $degree->fields->first();
        }


        $topic = Topic::create([
            'title'         => $data['title'],
            'description'   => $data['description'],
            'methodology'   => $data['methodology'],
            'deliverables'  => $data['deliverables'],
            'level_id'      => $degree->id,
            'field_id'      => $fieldOfStudy->id,
            'user_id'      => auth()->user()->id,
            'body'          => $data['body'],
            'image'         => $imagePath,
        ]);

        $topic->subjects()->sync($request->subject);

        if ($topic) {
            $request->session('success')->flash('success', "Topic has been submitted successfully");
        } else {
            $request->session('error')->flash('error', 'There was an error');
        }

        return redirect()->route('student.topics.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        return view('student.topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        $subjects = auth()->user()->fields->first()->subjects;
        return view('student.topics.edit', compact('topic','subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $request->validate([
            'title'         => 'required|min:15',
            'description'   => 'required|min:150|max:1500',
            'methodology'   => 'required|min:150|max:1500',
            'deliverables'  => 'required|min:150|max:1500',
            'body'          => 'required|min:150|max:1500',
            'image'         => 'image|sometimes|mimes:jpeg,bmp,png,jpg|max:2500',
        ]);

        if ($request->has('image')) {
            if ($topic->image != 'uploads/banner.jpg' and Storage::exists( 'public/'. $topic->image)) {
                Storage::delete('public/' .$topic->image);
            }
            $imagePath = $request['image']->store('uploads', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(2200, 1000);
            $image->save();
        } else {
            $imagePath = $topic->image;
        }



        $result = $topic->update([
            'title'         => $request->title,
            'description'   => $request->description,
            'methodology'   => $request->methodology,
            'deliverables'  => $request->deliverables,
            'body'          => $request->body,
            'image'         => $imagePath,
        ]);

        $topic->subjects()->sync($request->subject);

        if($result){
            $request->session('success')->flash('success', "Your topic has been updated");
        }else{
            $request->session('error')->flash('error', 'There was an error');
        }

        return redirect()->route('student.topics.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic, Request $request)
    {
        //delete stored image if post image is not the default img
        if ($topic->image != 'uploads/banner.jpg' and Storage::exists( 'public/'. $topic->image)) {
            Storage::delete('public/' .$topic->image);
        }
        //deletes the post
        $response = $topic->delete();

        //return flash message
        if($response){
            $request->session('success')->flash('success', "The post has been deleted successfully!");
        }else{
            $request->session('error')->flash('error', 'There was an error!');
        }
        //redirect to index posts page
        return redirect()->route('student.topics.index');
    }
}
