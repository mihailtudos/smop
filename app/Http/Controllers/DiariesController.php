<?php

namespace App\Http\Controllers;

use App\Diary;
use Illuminate\Http\Request;

class DiariesController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function show(Diary $diary)
    {
        $owner = $diary->user;
        $user = auth()->user();

        if ($user->hasRole('supervisor') or $owner->id == $user->id ){
            $supervisor = $user->supervisesTheStudent($owner);
            return view('common.diaries.show', compact('diary', 'owner'));
        }

        if ($user->hasRole('admin') or $owner->id == $user->id){
            return view('common.diaries.show', compact('diary', 'owner'));
        }

        return abort(403,'Unauthorised');
    }


}
