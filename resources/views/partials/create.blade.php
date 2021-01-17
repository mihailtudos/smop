@extends('layouts.app')
{{--{{dd($supervisors)}}--}}
@section('content')
    <div class="d-flex flex-row-reverse mb-4">
        @can('edit-projects')
        <a class="btn btn-primary ml-3" href="{{ route( auth()->user()->roles->first()->name .'.') }}" role="button">Go to the dashboard</a>
        @else
            <a class="btn btn-primary ml-3" href="{{ route( 'home') }}" role="button">Go to the dashboard</a>
        @endcan
    </div>

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card dashCard">

                @yield('createCard')

            </div>
        </div>
    </div>
@endsection
