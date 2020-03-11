@extends('layouts.app')

@section('content')
    {{--Quick links--}}
         @include('partials.quick')
    <div class="row">
        <div class="col-md-10">
            <div class="card dashCard">
                <div class="card-header text-center ">
                    <div>
                        <h4>{{$post->title}}</h4>
                    </div>
                </div>
                <img class="card-img-top w-100" src="{{ '/storage/'.$post->image }} "
                      alt="Card image cap">
                <div class="card-body">
                    <div class="text-center">
                        <p>
                            {{$post->body}}
                        </p>
                    </div>
                    <div class="d-flex justify-content-end">
                        <p>Created {{$post->created_at->diffForHumans() .' by '. $post->user->name}}</p>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
