<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = [];

    public function fields()
    {
        return $this->belongsToMany(Field::class)->withTimestamps();
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }

    public function suggestions()
    {
        return $this->belongsToMany(ProjectSuggestion::class)->withTimestamps();
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class)->withTimestamps();
    }

    public function pathToSuggestions()
    {
        return '/suggestions/subjects/'. $this->id;
    }
}

