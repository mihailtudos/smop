<?php

namespace App\Http\Controllers\Admin;

use App\Field;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Mail\Users\UserRegisteredMailable;
use App\Role;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    //middleware checks if the user is auth to access the controller
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
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields = Field::all();
        $roles = Role::all();


        return view('admin.users.create', compact(['fields', 'roles']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('edit-users')) {
            return redirect(route('admin.users.index'));
        }

        $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'field1' => 'required',
        ]);

        $passwordString = Str::random(8);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($passwordString),
        ]);

        $user->fields()->sync($request->field1);
        $user->roles()->sync($request->roles);

        if ($user) {
            $request->session('success')->flash('success', "User has been created");
            Mail::to($user)->send(new UserRegisteredMailable($user, $passwordString));
        } else {
            $request->session('error')->flash('error', 'There was an error');
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Gate::denies('edit-users')){
            return redirect(route('admin.users.index'));
        }
        $roles = Role::all();

        return view('admin.users.edit')->with([
            'roles' => $roles,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $result = $user->update($request->validate([
            'name' => 'required',
            'email' => 'required'
         ])
        );

        if($result){
            $request->session('success')->flash('success', "User $user->name has been updated");
        }else{
            $request->session('error')->flash('error', 'There was an error');
        }

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::denies('delete-users')){
            return redirect(route('admin.users.index'));
        }

        //detaches all roles
        $user->roles()->detach();

        //deletes the user
        $user->delete();

        //redirect to users page
        return redirect()->route('admin.users.index');
    }

    public function importCreate()
    {
        return view('admin.users.import.create');
    }

    public function importStore(Request $request)
    {
        Excel::import(new UsersImport(), $request->file('file'));

        return redirect(route('admin.users.index'));
    }
}
