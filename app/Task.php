<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Task extends Model
{
    use Notifiable;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class)->orderBy('created_at', 'desc');
    }

    public function completed()
    {
        $this->update([
            'completed' => 1
        ]);

        return true;
    }
}
