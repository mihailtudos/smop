@extends('layouts.app')

@section('content')
    {{--Quick links--}}
    @include('partials.quick')

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card dashCard">
                <div class="card-header d-flex justify-content-between align-items-end">
                    <h4>Posts List</h4>
                    <div><a class="btn btn-success border-dark" href="{{ route('admin.posts.create') }}" role="button">Create</a></div>
                </div>
                <div class="card-body">

                    <table class="table ">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Created</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($posts as $post)
                        <tr>
                            <td class="font-weight-bold">
                                <a class="" href="{{route('admin.posts.show', $post)}}">{{ $post->title }}</a>
                            </td>
                            <td> {{ $post->user->name }} </td>
                            <td> {{ $post->created_at->diffForHumans() }}</td>
                            <td> @can('manage-action')
                                    <a href="{{ route( 'admin.posts.edit', $post->id ) }}">
                                        <button class="btn btn-primary float-left float-left" type="button">
                                            <h4 class="m-0 ">
                                                <i class="fas fa-pen-nib"></i>
                                            </h4>
                                        </button>
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post" class="float-left">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route( 'admin.posts.destroy', $post->id ) }}">
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
                            <h5>No posts found, click create button to creat new post</h5>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $posts->links() }}
                    </div>



                </div>

            </div>
        </div>
    </div>
@endsection
