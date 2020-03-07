@extends('layouts.app')

@section('content')
    {{--Quick links--}}
    @include('partials.quick')

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-end">
                    <h4>Projects Suggestion List</h4>
                    @can('manage-projects')
                        <div>
                            <a class="btn btn-success border-dark" href="{{ route('admin.projects.create') }}" role="button">Create</a>
                        </div>
                    @endcan
                </div>
                <div class="card-body">

                    <table class="table ">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">Title</th>
                            <th scope="col">Level</th>
                            <th scope="col">Field</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($suggestions as $suggestion)
                            <tr>
                                <td class="font-weight-bold"><a href="{{$suggestion->path()}}">{{ $suggestion->title }}</a></td>
                                <td> {{ $suggestion->student->name }} </td>
                                <td> {{ $suggestion->supervisor->name }}</td>
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
                        @endforelse
                        </tbody>
                    </table>






                </div>

            </div>
        </div>
    </div>
@endsection
