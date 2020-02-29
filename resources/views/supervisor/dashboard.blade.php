@extends('layouts.app')

@section('content')

    <div class="container">
        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <h1><small>Welcome to supervisor  </small></span> Dashboard </h1>
                    </div>
                    <div class="col-md-2">

                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Quick action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('supervisor.projects.index')}}">All projects</a>
                                <a class="dropdown-item" href="{{ route('supervisor.projects.create') }}">Create new project</a>
                                <a class="dropdown-item" href="admin.mentors.create">Create new mastership</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </header>


        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header font-weight-bold"><h4>Dashboard</h4></div>
                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header"></h5>
                                    <div class="card-body">
                                        <h5 class="card-title">Manage projects</h5>
                                        <p class="card-text">
                                            To update, edit projects details, delete or create new projects click on the below button
                                        </p>
                                        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Manage projects</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header"></h5>
                                    <div class="card-body">
                                        <h5 class="card-title">Manage users</h5>
                                        <p class="card-text">
                                            To update permissions, edit account details, delete or create new users click on the below  button
                                        </p>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Manage users</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Recently created tasks</div>
                    <div class="card-body">

                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Access project</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse(\App\Task::where('user_id', Auth::user())->get() as $task)
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                            </tr>
                            @empty
                                <p>Wasn't found any task</p>
                            @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
