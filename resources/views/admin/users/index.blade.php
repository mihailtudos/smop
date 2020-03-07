@extends('layouts.app')

@section('content')

    {{-- Quick links section --}}
    @include('partials.quick')

    {{--    --}}
    <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-end">
                       <h4>Users List</h4>
                        <div>
                            <a class="btn btn-success border-dark" href="{{ route('admin.users.import.create') }}" role="button">Upload</a>
                            <a class="btn btn-success border-dark" href="{{ route('admin.users.create') }}" role="button">Create</a>
                        </div>
                    </div>

                    <div class="card-body">

                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id  }}</th>
                                        <td> {{ $user->name  }}</td>
                                        <td> {{ $user->email  }}</td>
                                        <td> {{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                        <td>
                                            @can('edit-users')
                                                <a href="{{ route( 'admin.users.edit', $user->id ) }}">
                                                    <button class="btn btn-primary float-left" type="button">
                                                        <h4 class="m-0">
                                                            <i class="fas fa-pen-nib"></i>
                                                        </h4>
                                                    </button>
                                                </a>
                                            @endcan
                                            @can('delete-users')
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" class="float-left">
                                                    @csrf
                                                    @method('delete')

                                                    <a href="{{ route( 'admin.users.destroy', $user->id ) }}">
                                                        <button class="btn btn-danger" type="submit">
                                                            <h4 class="m-0">
                                                                <i class="fas fa-eraser"></i>
                                                            </h4>
                                                        </button>
                                                    </a>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <p>No users found</p>
                                @endforelse
                                </tbody>
                            </table>
                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection
