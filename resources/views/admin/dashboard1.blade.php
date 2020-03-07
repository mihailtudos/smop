@extends('layouts.app')

@section('content')

    <div class="container">
        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"><small>
                               Welcome to admin  </small></span> Dashboard </h1>
                    </div>
                    <div class="col-md-2">

                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Quick action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('admin.users.create')}}">Create new user</a>
                                <a class="dropdown-item" href="{{ route('admin.projects.create') }}">Create new project</a>
                                <a class="dropdown-item" href="admin.mentors.create">Create new mastership</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </header>


        <div class="row justify-content-center mb-4">
            <div class="col-md-3 ">
                <!-- Side bar-cards -->
                <div class="list-group card dashCard mb-4">
                    <!-- side nav -->
                    <a href="index.html" class="list-group-item disabled list-group-item-action active main-color-bg"><h5><i class="fas fa-cogs"></i> Menu</h5></a>
                    <a href="pages.html" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-th-list"></i> Pages <span class="badge badge-success badge-pill">1</span></a>
                    <a href="posts.html" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-edit"></i> Posts <span class="badge badge-success badge-pill">1</span></a>
                    <a href="users.html" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-users-cog"></i> Users <span class="badge badge-success badge-pill">1</span></a>
                </div>

            </div>

            <div class="col-md-9">
                <div class="card dashCard">
                    <div class="card-header font-weight-bold"><h4>Dashboard</h4></div>
                    <div class="card-body">

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card dashCardMini">
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

                        <div class="col-md-6 mb-4">
                            <div class="card dashCardMini">
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

                        <div class="col-md-6 mb-4">
                            <div class="card dashCardMini">
                                <h5 class="card-header"></h5>
                                <div class="card-body">
                                    <h5 class="card-title">Manage posts</h5>
                                    <p class="card-text">
                                        To create, edit, or delete posts click on the below button. Created posts will be shown on student main page.
                                    </p>
                                    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Manage posts</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="offset-3 col-md-9">
                <div class="card dashCard">
                    <div class="card-header">Last five projects created</div>
                    <div class="card-body">

                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Student</th>
                                <th scope="col">Supervisor</th>
                                <th scope="col">Handle</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse(\App\Project::all() as $project)
                                <tr>
                                    <th scope="row"> {{$project->title}}</th>
                                    <td>{{ $project->student->name }}</td>
                                    <td>{{ $project->supervisor->name }}</td>
                                    <td><a href="{{$project->path()}}" role="button" class="btn btn-success" ><i class="fas fa-sign-out-alt"></i></a></td>
                                </tr>
                            @empty
                                <p>No projects yet</p>
                            @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
