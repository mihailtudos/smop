@extends('partials.index')


@section('contentIndex')
    <div class="card-header d-flex justify-content-between align-items-end">
        <h4>Study Courses List</h4>
        <div>
            <a class="btn btn-success border-dark" href="{{ route('admin.fields.create') }}" role="button">Create</a>
        </div>
    </div>
    <div class="card-body">

        <table class="table text-center">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Course Name</th>
                <th scope="col">Degree</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($fields as $field)
                <tr>
                    <td> {{ $field->name  }}</td>
{{--                    <td> {{ implode(', ', $field->levels()->get()->pluck('name')->toArray())  }}</td>--}}
                    <td> {{ $field->level->name  }}</td>
                    <td class="d-flex justify-content-center">
                        @can('admin')
                            <a class="mr-2" href="{{ route( 'admin.fields.edit', $field->id ) }}">
                                <button class="btn btn-primary float-left" type="button">
                                    <h4 class="m-0">
                                        <i class="fas fa-pen-nib"></i>
                                    </h4>
                                </button>
                            </a>
                            <form action="{{ route('admin.fields.destroy', $field->id) }}" method="post" class="float-left">
                                @csrf
                                @method('delete')

                                <a href="{{ route( 'admin.fields.destroy', $field->id ) }}">
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
            {{ $fields->links() }}
        </div>


    </div>
@endsection
