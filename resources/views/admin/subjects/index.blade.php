@extends('partials.index')


@section('contentIndex')
    <div class="card-header d-flex justify-content-between align-items-end">
        <h4>Study Subjects List</h4>
        <div>
            <a class="btn btn-success border-dark" href="{{ route('admin.subjects.create') }}" role="button">Create</a>
        </div>
    </div>
    <div class="card-body">

        <table class="table text-center">
            <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">Subject </th>
                <th scope="col">Belongs to Courses</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($subjects as $subject)
                <tr>
                    <td> {{ $subject->name  }}</td>
                    <td> {{ implode(', ', $subject->fields()->get()->pluck('name')->toArray())  }}</td>
                    <td class="">
                        @can('admin')
                            <div>
                                <a class="mr-2" href="{{ route( 'admin.subjects.edit', $subject->id ) }}">
                                    <button class="btn btn-primary float-left" type="button">
                                        <h4 class="m-0">
                                            <i class="fas fa-pen-nib"></i>
                                        </h4>
                                    </button>
                                </a>
                            </div>
                            <div class="mt-n3">
                                <form action="{{ route('admin.subjects.destroy', $subject->id) }}" method="post" class="float-left">
                                    @csrf
                                    @method('delete')

                                    <a href="{{ route( 'admin.subjects.destroy', $subject->id ) }}">
                                        <button class="btn btn-danger" type="submit">
                                            <h4 class="m-0">
                                                <i class="fas fa-eraser"></i>
                                            </h4>
                                        </button>
                                    </a>
                                </form>
                            </div>
                        @endcan
                    </td>
                </tr>
            @empty
            @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $subjects->links() }}
        </div>


    </div>
@endsection
