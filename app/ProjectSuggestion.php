<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSuggestion extends Model
{
    protected $guarded = [];
    protected $table = 'project_suggestions';

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
