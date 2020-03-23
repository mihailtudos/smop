<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->withTimestamps();
    }

    public function project()
    {
        return $this->hasOne(Project::class);
    }

    public function path()
    {
        if (auth()->user()->hasRole('admin') or auth()->user()->id == $this->user_id){
            return '/student/topics/'. $this->id;
        }
            return redirect()->back()->with('error', 'Not allowed to access this page!');
    }

    public function isTopicTaken(){
        if($this->project != null){
            return false;
        }
        return true;
    }
}
