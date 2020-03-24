<?php

namespace App\Http\Controllers\Student;

use App\EthicForm;
use App\Http\Controllers\Controller;
use App\Policies\EthicFormPolicy;
use App\User;
use Illuminate\Http\Request;

class EthicFormsController extends Controller
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
        $form = auth()->user()->ethicalForm()->first();
        return view('student.ethicalForm.index', compact('form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('student.ethicalForm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', EthicFormPolicy::class);
            $user = auth()->user();
        if ($user->hasRole('student') and $user->projects != null){
            $data = $request->validate([
                'title' => 'required|min:5',
                'body' => 'required|min:5'
            ]);

            $form = $user->ethicalForm()->create([
                'title' => $data['title'],
                'project_id' => $user->projects->id,
                'body' => $data['body'],
            ]);


            dd($form);
        }

        return redirect('home')->with('error', 'You have not been assigned a supervisor yet!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EthicForm  $ethicForm
     * @return \Illuminate\Http\Response
     */
    public function show(EthicForm $ethicForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EthicForm  $ethicForm
     * @return \Illuminate\Http\Response
     */
    public function edit(EthicForm $ethicForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EthicForm  $ethicForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EthicForm $ethicForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EthicForm  $ethicForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(EthicForm $ethicForm)
    {
        //
    }
}
