<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EthicForm extends Model
{
    protected $guarded = [];
    use Notifiable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return '/student/ethics/form/'. $this->id;
    }
}
