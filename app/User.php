<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //user related fields that would have to be provided by the coordinator upon new user registration
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //returns the roles a user belongs to
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function fields()
    {
        return $this->belongsToMany(Field::class)->withTimestamps();
    }

    public function levels()
    {
        return $this->belongsToMany(Level::class)->withTimestamps();
    }

    public function projects()
    {
        return $this->hasOne(Project::class, 'student_id');
    }

    public function monitoredProjects()
    {
        return $this->hasMany(Project::class, 'supervisor_id');
    }
    public function supervisee()
    {
        return $this->hasMany('User','student_id','user_id');
    }

    public function addSupervisee(User $user)
    {
        $this->supervisee()->attach($user->id);
        return true;
    }

    public function removeSupervisee(User $user)
    {
        $this->supervisee()->detach($user->id);
        return true;
    }

    public function  hasAnyRoles($roles){
       if($this->roles()->whereIn('name', $roles)->first()){
           return true;
       }
       return false;
    }

    public function hasRole($role)
    {
        if($this->roles()->where('name', $role)->first()){
            return true;
        }
        return false;
    }

    public function userWithLevel($level)
    {
        if($this->levels()->where('id', $level)->get()){
            return true;
        }
        return false;
    }

    //creates a method that would allow the interaction between the objects
    public function posts()
    {
        //return all users posts based on database relation where a user can have many posts
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function suggestions()
    {
        return $this->hasMany(ProjectSuggestion::class)->orderBy('created_at', 'desc');
    }

    public function emails()
    {
        return $this->hasMany('App\EmailLog',  'from_user_id')->orderBy('created_at', 'desc')->paginate(15);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class)->orderBy('created_at', 'desc');
    }

    public function diaries()
    {
        return $this->hasMany(Diary::class)->orderBy('created_at', 'desc');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function path()
    {
        if ($this->hasAnyRoles(['admin', 'supervisor', 'student'])){
            return '/profiles/'.$this->id;
        } else {
            return route('home');
        }
    }

    public function checkProfile($profile)
    {

        if ($this->hasRole('admin')){
            return true;
        } else if ($this->hasRole('supervisor')){
            if ($this->profile->id == $profile or $this->monitoredProjects->pluck('student_id')->contains($profile)){
                return true;
            }
                return false;
        } else if ($this->hasRole('student')) {
            if ($this->profile->id == $profile){
                return true;
            }
            return false;
        }
        return false;
    }

    public function ethicalForm()
    {
        return $this->hasOne(EthicForm::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class)->orderBy('created_at', 'desc');
    }

    public function supervisesTheStudent(User $user)
    {
        if ($this->hasRole('supervisor') and $this->monitoredProjects != null){

            if ($this->monitoredProjects->contains('student_id', $user->id)){
                return true;
            }
                return false;

        }
        return false;
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class)->orderBy('created_at', 'desc');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
