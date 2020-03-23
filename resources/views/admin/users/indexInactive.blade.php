@extends('partials.index')


@section('contentIndex')
    <div class="card-header d-flex justify-content-between align-items-end">
        <h4>Inactive Users List</h4>
        <div>
            <a class="btn btn-success border-dark" href="{{ route('admin.levels.create') }}" role="button">Create</a>
        </div>
    </div>
    <div class="card-body">

        <div>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col" class="text-center" scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td><a href="{{ $user->path() }}">{{ $user->name  }}</a> </td>
                        <td> {{ $user->email  }}</td>
                        <td> {{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <div>
                                    <a href="{{ route( 'admin.users.edit', $user ) }}" class="mr-2">
                                       recover
                                    </a>
                                </div>

                                <div>
                                    @can('admin')
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" class="float-left">
                                            @csrf
                                            @method('delete')

                                            <a href="{{ route( 'admin.users.destroy', $user->id ) }}">
                                                delete
                                            </a>
                                        </form>
                                    @endcan
                                </div>
                            </div>

                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div>


    </div>
@endsection
