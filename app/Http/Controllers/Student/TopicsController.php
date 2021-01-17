<?php

namespace App\Http\Controllers\Student;

use App\ActivityTitle;
use App\Field;
use App\Http\Controllers\Controller;
use App\Level;
use App\Notifications\UserTopicsSubmitted;
use App\Role;
use App\Subject;
use App\Topic;
use App\User;
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
        if (auth()->user()->fields == null){
            return redirect('home')->with('error', 'Contact your coordinator to assign you a field before creating a topic');
        }

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
        if (!auth()->user()->hasRole('student') or auth()->user()->topics->count() >= 3 or auth()->user()->projects != null){
            return redirect()->back()->with('error', 'You are not allowed to create more topics!');
        }

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
        if (!auth()->user()->hasRole('student') or auth()->user()->topics->count() >= 3 or auth()->user()->projects != null){
            return redirect()->back()->with('error', 'You are not allowed to create more topics!');
        }

        $data = $request->validate([
            'title'         => 'required|min:15|max:160',
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
            return redirect()->route('home')->with('error', 'Contact your admin to assign you a degree lavel');
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
        $activity = ActivityTitle::where('activity_title', 'new topic submitted')->first();

        if ($activity){
            auth()->user()->activities()->create([
                'activity_title_id' =>  $activity->id
            ]);
        }


        if ($topic) {
            $request->session('success')->flash('success', "Topic has been submitted successfully");
            if (auth()->user()->topics->count() == 2 and Role::where('name', 'admin')->first()->users->count() != 0){
                foreach (Role::where('name', 'admin')->first()->users as $admin){
                    $admin->notify(new UserTopicsSubmitted([
                        'name' => $topic->user->name,
                        'link' => $topic->user->profile->path(),
                    ]));
                }
            }
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
        if ($topic->project != null){
            return redirect()->back()->with('error', 'The topic was already assigned and cannot be modified anymore!');
        }
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
            'title'         => 'required|min:15|max:160',
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
        if ($topic->project != null and !auth()->user()->hasRole('admin')){
            return redirect()->back()->with('error', 'The topic was already assigned and cannot be deleted anymore!');
        }
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
