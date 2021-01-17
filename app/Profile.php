<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->withTimestamps();
    }

    public function checkAvailability()
    {
        if ($this->availability > 0 and $this->user->monitoredProjects->count()+1 <= $this->availability){
            return true;
        }
        return false;
    }

    public function path()
    {
        return '/profiles/'. $this->user->id;
    }
}
