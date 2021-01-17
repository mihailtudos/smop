<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Meeting extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class)->orderBy('created_at', 'desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->orderBy('created_at', 'desc');
    }

    //creates a method that would allow the interaction between the objects
    public function diary()
    {
        //returns a single diary record as result of a meeting
        return $this->hasOne(Diary::class);
    }
}
