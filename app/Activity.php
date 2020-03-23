<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Activity extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activityTitle()
    {
        return $this->belongsTo(ActivityTitle::class);
    }

    public function store($request)
    {
        if (isset($request)){
            auth()->user()->activities()->create([
                'activity_title' => $request
            ]);
        }

        return redirect()->back('error', 'Activity unrecorded!!!');

    }
}
