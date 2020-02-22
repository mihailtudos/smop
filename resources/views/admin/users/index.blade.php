@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Users List</div>

                    <div class="card-body">

                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id  }}</th>
                                        <td> {{ $user->name  }}</td>
                                        <td> {{ $user->email  }}</td>
                                        <td>
                                            <a href="{{ route( 'admin.users.edit', $user->id ) }}"><button class="btn btn-primary" type="button">Edit</button></a>
                                            <a href="{{ route( 'admin.users.destroy', $user->id ) }}"><button class="btn btn-danger" type="button">Delete</button></a>
                                        </td>
                                    </tr>
                                @empty
                                    <p>No users found</p>
                                @endforelse
                                </tbody>
                            </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
