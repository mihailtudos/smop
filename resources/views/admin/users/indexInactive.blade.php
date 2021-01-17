@extends('partials.index')



@section('contentIndex')
    <div class="card-header d-flex justify-content-between align-items-end">
        <h4>Inactive Users List</h4>
        <div>
            <a class="btn btn-secondary border-dark" href="{{ route('admin.users.index') }}" role="button">Back</a>
        </div>
    </div>
    <div class="card-body">

        <div>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Inactive since</th>
                    <th scope="col">Role</th>
                    <th scope="col" class="text-center" scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name  }}</td>
                        <td> {{ $user->deleted_at->format('d-m-yy')  }}</td>
                        <td> {{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                        <td>
                            <div class="">
                                <div >
                                    <form action="{{ route('admin.users.restore', $user->id) }}" method="post" class="float-left">
                                        @csrf
                                        @method('put')

                                        <button  class="mr-2 text-success" type="submit">
                                            <h4 class="m-0">
                                                <i class="fas fa-arrow-circle-left"></i>
                                            </h4>
                                        </button>
                                    </form>
                                </div>

                                <div>
                                    <form action="{{ route('admin.users.forced', $user->id) }}" method="post" class="float-left">
                                        @csrf
                                        @method('delete')
                                        <button class="" type="submit">
                                            <h4 class="m-0 text-danger">
                                                <i class="fas fa-eraser"></i>
                                            </h4>
                                        </button>
                                    </form>
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
