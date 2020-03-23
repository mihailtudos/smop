<?php

namespace App\Http\Controllers\Admin;

use App\Field;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Level;
use App\Mail\Users\UserRegisteredByImportMailable;
use App\Mail\Users\UserRegisteredMailable;
use App\Role;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $fields = Field::all();

        $users = User::whereHas('levels', function($q){
            $q->where('level_id', request('field'));
        })->paginate(10);

        if (request()->has('field')){
            $users = Field::where('id', request('field'))->first()->users()->paginate(10);
        }else {
            $users = User::orderBy('created_at', 'desc')->paginate(10);
        }

        return view('admin.users.index', compact('users', 'fields'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $degrees = Level::all();
        $roles = Role::all();

        return view('admin.users.create', compact(['degrees', 'roles']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'degree'        => 'sometimes',
            'degreeFields'  => 'sometimes',
            'role'          => 'required',
        ]);

        $passwordString = Str::random(8);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($passwordString),
        ]);

        $user->levels()->sync($request->degree);
        $user->fields()->sync($request->degreeFields);
        $user->roles()->sync($request->role);

        $user->profile()->create([]);


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
        if(Gate::denies('admin-supervise')){
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
            'email' => 'required|unique:users'
         ])
        );


        $user->roles()->sync($request->roles);
        if($result){
            $request->session('success')->flash('success', "User $user->name has been updated");
        }else{
            $request->session('error')->flash('error', 'There was an error');
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
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
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }

    public function importCreate()
    {
        return view('admin.users.import.create');
    }

    public function importStore(Request $request)
    {
        $user = Excel::import(new UsersImport(), $request->file('file'));

        if ($user) {
            $request->session('success')->flash('success', "All records has been saved!");
        } else {
            $request->session('error')->flash('error', 'There was an error!');
        }

        return redirect(route('admin.users.index'));
    }

    public function fetch(Request $request)
    {
        $degreeId = $request->get('degreeId'); //ex $field_name = 'IT';
        $role_name = $request->get('dependent'); // for example $role_name = 'supervisor'

        $supervisors = Level::find($degreeId)->fields;
        $data = $supervisors;

        $output = '<option value=""> Select ' .ucfirst($role_name).'.</option>';
        foreach ($data as $row) {
            $output .= '<option value="'. $row->id.'">'.$row->name .'</option>';
        }
        echo $output;

    }
}
