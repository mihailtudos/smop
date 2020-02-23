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
                                <a class="dropdown-item" href="#">Create new user</a>
                                <a class="dropdown-item" href="#">Send email</a>
                                <a class="dropdown-item" href="#">Projects</a>
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
                                    <h5 class="card-title">Manage users</h5>
                                    <p class="card-text">
                                        To update permissions, edit account details, delete or create new users click on the below  button
                                    </p>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Manage users</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <h5 class="card-header"></h5>
                                <div class="card-body">
                                    <h5 class="card-title">Manage projects</h5>
                                    <p class="card-text">
                                        To update, edit projects details, delete or create new projects click on the below button
                                    </p>
                                    <a href="#" class="btn btn-primary">Manage projects</a>
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
                    <div class="card-header">Projects recently created</div>
                    <div class="card-body">

                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
