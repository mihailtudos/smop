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
        return '/diary/record/'. $this->id;
    }

    public function meeting()
    {
        return $this->hasOne(Meetings::class);
    }

}
