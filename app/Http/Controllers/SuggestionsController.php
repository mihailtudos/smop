<?php

namespace App\Http\Controllers;

use App\Field;
use App\ProjectSuggestion;
use App\Subject;
use Illuminate\Http\Request;

class SuggestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectSuggestion  $projectSuggestion
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectSuggestion $projectSuggestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectSuggestion  $projectSuggestion
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectSuggestion $projectSuggestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectSuggestion  $projectSuggestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectSuggestion $projectSuggestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectSuggestion  $projectSuggestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectSuggestion $projectSuggestion)
    {
        //
    }

    public function subject(Subject $subject)
    {
        dd($subject);
    }

    public function byFields(Field $field)
    {
        $suggestions = $field->suggestions;

        return view('common.suggestions.index', compact('field', 'suggestions'));
    }

    public function bySubject(Subject $subject)
    {
        $suggestions = $subject->suggestions;
        $field = $subject;
        return view('common.suggestions.index', compact('field', 'suggestions'));
    }
}
