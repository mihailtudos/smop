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

    public function fields()
    {
        return $this->belongsToMany(Field::class)->withTimestamps();
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->withTimestamps();
    }

    public function path()
    {
        return '/suggestions/'. $this->id;
    }

}
