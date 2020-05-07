@extends('partials.index')

@section('contentIndex')
                    <div class="card-header d-flex justify-content-between align-items-end">
                        <h4>Users list</h4>
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

                        <div class="mx-2">
                            <a class="btn btn-secondary border-dark" href="{{ route('admin.users.import.create') }}" role="button">Upload</a>
                        </div>
                        <div class="">
                            <a class="btn btn-success border-dark" href="{{ route('admin.users.create') }}" role="button">Create</a>
                        </div>

                    </div>

                    

                    <div class="card-body">
                        <div class="table-responsive ">
                            <table class="table text-left">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">name</th>
                                    <th scope="col">role</th>
                                    <th scope="col" class="text-right">action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td><a href="{{ $user->path() }}">{{ $user->name  }}</a> </td>
                                        <td> {{ implode(', ', $user->roles()->get()->pluck('name')->toarray()) }}</td>
                                        <td class="">

                                            <a href="{{ route( 'admin.users.edit', $user ) }}" class="mr-2">
                                                <button class="btn btn-primary float-right" type="button">
                                                    <h4 class="m-0">
                                                        <i class="fas fa-pen-nib"></i>
                                                    </h4>
                                                </button>
                                            </a>

                                            @can('admin')
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" class="float-right">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger" type="submit">
                                                        <h4 class="m-0">
                                                            <i class="fas fa-eraser"></i>
                                                        </h4>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <p>no users found</p>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div>
@endsection
