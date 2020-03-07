@extends('partials.index')


@section('contentIndex')
    <div class="card-header d-flex justify-content-between align-items-end">
        <h4>Study Degree Level List</h4>
        <div>
            <a class="btn btn-success border-dark" href="{{ route('admin.levels.create') }}" role="button">Create</a>
        </div>
    </div>
    <div class="card-body">

        <table class="table text-center">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Study Level</th>
                <th scope="col">Study Fields</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($levels as $level)
                <tr>
                    <td> {{ $level->name  }}</td>
                    <td> {{ implode(', ', $level->fields()->get()->pluck('name')->toArray())  }}</td>
                    <td class="d-flex justify-content-center">
                        @can('admin')
                            <a class="mr-2" href="{{ route( 'admin.levels.edit', $level->id ) }}">
                                <button class="btn btn-primary float-left" type="button">
                                    <h4 class="m-0">
                                        <i class="fas fa-pen-nib"></i>
                                    </h4>
                                </button>
                            </a>
                        @endcan
                        @can('admin')
                            <form action="{{ route('admin.levels.destroy', $level) }}" method="post" class="float-left">
                                @csrf
                                @method('delete')

                                <a href="{{ route( 'admin.levels.destroy', $level->id ) }}">
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
            @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $levels->links() }}
        </div>


    </div>
@endsection
