@extends('layouts.app')

@section('content')

    @include('partials.quick')

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card dashCard">
                @yield('contentIndex')
            </div>
        </div>
    </div>
@endsection
