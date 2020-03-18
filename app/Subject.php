<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = [];

    public function fields()
    {
        return $this->belongsToMany(Field::class);
    }


    public function topics()
    {
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }
}
