@extends('layouts.app')

@section('content')
    {{--Quick links--}}
    @include('partials.quick')

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-end">
                    <h4>Submitted Topics</h4>
                    @can('student')
                        <div>
                            <a class="btn btn-primary border-dark" href="{{ route('student.topics.create') }}" role="button">Create</a>
                        </div>
                    @endcan
                </div>
                <div class="card-body">

                    <table class="table ">
                        <thead class="thead-dark">
                        <tr class="text-center">
                            <th scope="col" class="text-center">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($topics as $topic)
                            <tr>
                                <td class="font-weight-bold"><a href="{{$topic->path()}}">{{ Str::limit($topic->title, '55') }}</a></td>
                                <td > {{ Str::limit($topic->description, '200') }} </td>
                                <td> {{  $topic->created_at->diffForHumans() }}</td>
                                @if(!$topic->user->projects()->count())
                                <td> @can('student')
                                        <a href="{{ route( 'student.topics.edit', $topic->id ) }}">
                                            <button class="btn btn-primary float-left float-left" type="button">
                                                <h4 class="m-0 ">
                                                    <i class="fas fa-pen-nib"></i>
                                                </h4>
                                            </button>
                                        </a>
                                        <form action="{{ route('student.topics.destroy', $topic->id) }}" method="post" class="float-left">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ route( 'student.topics.destroy', $topic->id ) }}">
                                                <button class="btn btn-danger " type="submit">
                                                    <h4 class="m-0">
                                                        <i class="fas fa-eraser"></i>
                                                    </h4>
                                                </button>
                                            </a>
                                        </form>
                                    @endcan
                                </td>
                                @endif
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
