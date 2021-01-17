<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //the fields needed to create the object
    protected $fillable = [
        'name'
    ];

    //return all users the role belongs to
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}


























