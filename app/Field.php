<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->withTimestamps();
    }

    public function suggestions()
    {
        return $this->belongsToMany(ProjectSuggestion::class)->withTimestamps();
    }

    public function pathToSuggestions()
    {
        return '/suggestions/fields/'. $this->id;
    }
}
