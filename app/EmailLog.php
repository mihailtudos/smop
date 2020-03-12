<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from_user_id',
        'to_user_id',
    ];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'id', 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'id', 'to_user_id');
    }
}
