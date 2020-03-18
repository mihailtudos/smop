<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSuggestion extends Model
{
    protected $guarded = [];
    protected $table = 'project_suggestions';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    public function user()
//    {
//        return $this->belongsTo(User::class)->orderBy('created_at', 'desc')->paginate(7);
//    }
}
