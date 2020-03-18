<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function suggestions()
    {
//      return $this->hasMany(ProjectSuggestion::class)->orderBy('created_at', 'desc')->paginate(7);
        return $this->hasMany(ProjectSuggestion::class)->orderBy('created_at', 'DESC');
    }

    public function emails()
    {
        return $this->hasMany('App\EmailLog',  'from_user_id')->orderBy('created_at', 'desc')->paginate(15);
    }

}
