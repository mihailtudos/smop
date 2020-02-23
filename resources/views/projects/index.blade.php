@extends('layouts.app')

@section('content')


    <div class="d-flex flex-row-reverse mb-4">
        <a class="btn btn-primary ml-3" href="{{ route('admin.') }}" role="button">Go to the dashboard</a>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Create new user
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('admin.users.create')}}">Create new user</a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users List</div>

                <div class="card-body">


                </div>

            </div>
        </div>
    </div>
@endsection
