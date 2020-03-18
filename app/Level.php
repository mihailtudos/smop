<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $guarded = [];

    public function fields()
    {
        return $this->belongsToMany(Field::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
