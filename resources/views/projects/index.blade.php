@extends('layouts.app')

@section('content')

        @include('partials.quick')

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users List</div>

                <div class="card-body">
                @yield('contentIndex')
                </div>
            </div>
        </div>
    </div>
@endsection
