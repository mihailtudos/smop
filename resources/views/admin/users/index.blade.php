@extends('partials.index')

@section('contentIndex')
                    <div class="card-header d-flex justify-content-between align-items-end">
                        <div class="mt-3">
                            <div class="dropdown">

                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Filter
                                </a>

                                <div class="dropdown-menu" aria-labelledby="filterDropdown">
                                    @foreach($fields as $field)
                                    <a class="dropdown-item" href="/admin/users/?field={{ $field->id }}">{{ $field->name }}</a>
                                    @endforeach
                                        <div>
                                            <a class="dropdown-item" href="/admin/users/?inactive=all">Inactive users</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <h4>Users list</h4>

                        <div class="float-right">
                            <a class="btn btn-secondary border-dark" href="{{ route('admin.users.import.create') }}" role="button">Upload</a>
                            <a class="btn btn-success border-dark" href="{{ route('admin.users.create') }}" role="button">Create</a>
                        </div>
                    </div>

                    <div class="card-body">

                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">name</th>
                                    <th scope="col">email</th>
                                    <th scope="col">role</th>
                                    <th class="text-right pr-5" scope="col">action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td><a href="{{ $user->path() }}">{{ $user->name  }}</a> </td>
                                        <td> {{ $user->email  }}</td>
                                        <td> {{ implode(', ', $user->roles()->get()->pluck('name')->toarray()) }}</td>
                                        <td class="d-flex justify-content-end">

                                                <a href="{{ route( 'admin.users.edit', $user ) }}" class="mr-2">
                                                    <button class="btn btn-primary float-left" type="button">
                                                        <h4 class="m-0">
                                                            <i class="fas fa-pen-nib"></i>
                                                        </h4>
                                                    </button>
                                                </a>

                                            @can('admin')
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
                                    <p>no users found</p>
                                @endforelse
                                </tbody>
                            </table>
                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div>
@endsection
