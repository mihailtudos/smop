<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Intervention\Image\Facades\Image;
use Gate;
use Illuminate\Http\Request;

class PostsController extends Controller
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
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
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
            'title' => 'required',
            'description' => 'required',
            'body' => 'required',
            'image' => 'image',
        ]);

        if ($request->has('image')){
            $imagePath = $request['image']->store('uploads', 'public');
        }else {
                $imagePath = 'uploads/banner.jpg';
        }

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();


        $post = auth()->user()->posts()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'body' => $data['body'],
            'image' => $imagePath,
        ]);

        if($post){
            $request->session('success')->flash('success', "New post has been created successfully!");
        }else{
            $request->session('error')->flash('error', 'There was an error!');
        }

        return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(Gate::denies('admin')){
            return redirect(route('admin.posts.index'));
        }

        return view('admin.posts.edit')->with([
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->validate([
            'title' => 'required',
            'description' => 'required',
            'body' => 'required',
        ]));

        if($post){
            $request->session('success')->flash('success', "The post has been updated successfully!");
        }else{
            $request->session('error')->flash('error', 'There was an error!');
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Request $request)
    {
        //deletes the user
        $response = $post->delete();

        if($response){
            $request->session('success')->flash('success', "The post has been deleted successfully!");
        }else{
            $request->session('error')->flash('error', 'There was an error!');
        }

        //redirect to users page
        return redirect()->route('admin.posts.index');
    }
}
