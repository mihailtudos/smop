<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/posts/{$this->id}";
    }

    //creates a method that would allow the interaction between the objects (user and post)
    public function user()
    {
        //return the user that created the posts (owner, author)
        // based on database relation where a user can have many posts
        return $this->belongsTo(User::class);
    }
}
