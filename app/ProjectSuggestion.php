<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSuggestion extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "suggestions/{$this->id}";
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
