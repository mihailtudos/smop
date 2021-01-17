@extends('layouts.app')

@section('content')
    {{--Quick links--}}
    @include('partials.quick')

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-end">
                    <h4>Projects List</h4>
                </div>
                <div class="card-body">

                    <table class="table ">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Student</th>
                            <th scope="col">Supervisor</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($projects as $project)
                        <tr>
                            <td class="font-weight-bold"><a href="{{$project->path()}}">{{ $project->title }}</a></td>
                            <td> {{ $project->student->name }} </td>
                            <td> {{ $project->supervisor->name }}</td>
                            <td> @can('manage-action')
                                    <a href="{{ route( 'admin.projects.edit', $project->id ) }}">
                                        <button class="btn btn-primary float-left float-left" type="button">
                                            <h4 class="m-0 ">
                                                <i class="fas fa-pen-nib"></i>
                                            </h4>
                                        </button>
                                    </a>
                                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="post" class="float-left">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route( 'admin.projects.destroy', $project->id ) }}">
                                            <button class="btn btn-danger " type="submit">
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
                            <h5>No projects yet</h5>
                        @endforelse
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
@endsection
