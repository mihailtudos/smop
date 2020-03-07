@extends('layouts.app')

@section('content')
    <div class="mb-2">
        @include('partials/breadcrumb')
    </div>

    <div class="row justify-content-center ">
        <div class="col-md-8 mb-4">
            <div class="card dashCard">
                <div class="card-header">
                    <h4>Noticeboard</h4>
                </div>

                <div class="card-body">

                    @forelse($posts as $post)
                        <div class="media mb-4">
                            <div class="postIcon">
                                <i class="fas mr-3 fa-paste"></i>
                            </div>
                            <div class="media-body">
                                <h5 class="mt-0">
                                    <a href="{{ $post->path() }}">
                                        {{ $post->title }}
                                    </a>
                                </h5>
                                <p>
                                    {{$post->description}}
                                </p>
                            </div>
                        </div>
                    @empty
                        <h4>No posts yet</h4>
                    @endforelse

                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card dashCard">
                <div class="card-header d-flex justify-content-between align-items-end">
                    <h4>Details</h4>
                </div>
                <div class="">
                    <ul class="list-group ">
                        <li class="list-group-item text-center font-weight-bolder">
                            <a href=" {{auth()->user()->projects->path()}} "><h5>Workshop</h5></a>

                        </li>
                        <li class="list-group-item d-flex justify-content-between">Created: <span class=" badge-success badge-pill">{{$post->created_at->diffForHumans()}}</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-end">Updated: <span class=" badge-success badge-pill">{{$post->updated_at->diffForHumans()}}</span></li>
                    </ul>
                </div>
            </div>
    </div>
@endsection
