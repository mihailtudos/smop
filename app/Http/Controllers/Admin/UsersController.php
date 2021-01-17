<?php

namespace App\Http\Controllers\Admin;

use App\Field;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Level;
use App\Mail\Users\UserRegisteredByImportMailable;
use App\Mail\Users\UserRegisteredMailable;
use App\Profile;
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
        if (\request()->has('inactive')){
            return redirect()->route('admin.users.inactive.index');
        }

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

        //retries all study degree levels from the database
        $degrees = Level::all();
        //retries all user roles from the database
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
//        $this->authorize('create', User::class);


        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'degree'        => 'sometimes',
            'degreeFields'  => 'sometimes',
            'role'          => 'required',
        ]);

        $passwordString = Str::random(8);

        //A new user record will be created with the given data
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($passwordString),
        ]);

        //inserts a new record in level_user table
        $user->levels()->sync($request->degree);
        //inserts a new record in field_user table
        $user->fields()->sync($request->degreeFields);
        //inserts a new record in role_user table
        $user->roles()->sync($request->role);

        //creates a new profile record in the database
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
            'email' => 'required|unique:users,email,'.$user->id
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


        //deletes the user
        $user->profile()->delete();
        $user->topics()->delete();
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

    public function inactiveIndex()
    {
        $users = User::onlyTrashed()->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users.indexInactive', compact('users'));
    }

    public function restore($id)
    {
        if(Gate::denies('delete-users')){
            return redirect(route('admin.users.index'));
        }

        $user = User::where('id', $id)->withTrashed()->first();
        $userRestored = $user->restore();

        $profile = Profile::where('user_id', $user->id)->withTrashed()->first()->restore();

        if($profile and $userRestored){
           return redirect()->back()->with('success', 'User account was successfully restored');
       }
            return redirect()->back()->with('error', 'User account could not be restored');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function forcedelete($id)
    {
        if(Gate::denies('delete-users')){
            return redirect(route('admin.users.index'));
        }

        $user = User::where('id', $id)->withTrashed()->first();

        $user->forceDelete();

        return redirect()->route('admin.users.inactive.index')->with('success', 'User deleted successfully!');
    }
}
