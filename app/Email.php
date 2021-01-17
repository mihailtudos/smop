<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $guarded = [];
    protected $table = 'email_logs';

    public function user()
    {
        $this->belongsToMany('App\User', 'users','from_user_id')->orderBy('created_at', 'desc');
    }
}
