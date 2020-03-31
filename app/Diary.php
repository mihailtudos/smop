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

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

}
