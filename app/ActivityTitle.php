<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityTitle extends Model
{
    protected $guarded = ['activity_title'];

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }
}
