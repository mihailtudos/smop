@extends('layouts.app')

@section('content')
    {{--Quick links--}}
    @include('partials.quick')
    <div class="row">
        @if($project->student->id == auth()->user()->id)
            @include('partials.studentProjectPanel')
        @else
            @include('partials.adminProjectPanel')
        @endif
    </div>
@endsection
