@extends('layouts.app')
{{--{{dd($supervisors)}}--}}
@section('content')
    <div class="d-flex flex-row-reverse mb-4">
        <a class="btn btn-primary ml-3" href="{{ route('admin.') }}" role="button">Go to the dashboard</a>
    </div>

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card dashCard">

                @yield('createCard')

            </div>
        </div>
    </div>
@endsection
