<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function path()
    {
        return '/diaries/'. $this->id;
    }

    //creates a method that would allow the interaction between the objects
    public function meeting()
    {
        //return a single meeting record related to the diary record
        return $this->belongsTo(Meeting::class);
    }

}
