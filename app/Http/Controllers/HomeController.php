<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        if(auth()->user()->hasRole('admin')){
            return redirect()->route('admin.');
        } elseif (auth()->user()->hasRole('supervisor')){
            return redirect()->route('supervisor.');
        }

        $posts = Post::latest()->paginate(15);
        return view('home', compact('posts'));
    }

}
