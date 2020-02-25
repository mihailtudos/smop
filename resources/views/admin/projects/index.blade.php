@extends('layouts.app')

@section('content')
    {{--Quick links--}}
    @include('partials.quick')

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-end">
                    <h4>Users List</h4>
                    <div><a class="btn btn-primary" href="{{ route('admin.projects.create') }}" role="button">Create</a></div>
                </div>
                <div class="card-body">


                </div>

            </div>
        </div>
    </div>
@endsection
