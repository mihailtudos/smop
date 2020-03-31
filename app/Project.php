<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use Notifiable;

    protected $guarded = [];

    public function path()
    {
        return "/projects/{$this->id}";
    }
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class)->orderBy('updated_at', 'desc');
    }

    public function addTask($title, $user_id)
    {
        return $this->tasks()->create(compact(['title', 'user_id']));
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class)->orderBy('updated_at', 'desc');
    }

    public function ethicalForm()
    {
        return $this->hasOne(EthicForm::class);
    }
}
