<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Meetings extends Model
{
    protected $guarded = [];
    use Notifiable;


    public function project()
    {
        return $this->belongsTo(Project::class)->orderBy('created_at', 'desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->orderBy('created_at', 'desc');
    }
}
