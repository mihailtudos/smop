@extends('layouts.app')

@section('content')
    {{--Quick links--}}
         @include('partials.quick')
    <div class="">
        <div class="">
            <div class="card dashCard">
                <div class="card-header text-center ">
                    <div>
                        <h4> {{$topic->title}} </h4>
                        <span class="text-left">
                            <a href="{{ route( 'student.topics.edit', $topic->id ) }}">
                                <button class="btn btn-primary " type="button">
                                    <h4 class="m-0 "><i class="fas fa-pen-nib"></i></h4>
                                </button>
                            </a>
                        </span>
                    </div>
                </div>
                <img class="card-img-top w-100" src="{{ '/storage/'.$topic->image }} "
                      alt="Card image cap">
                <div class="card-body">
                    <div class="text-justify jumbotron">
                       <div class="mb-5">
                           <h1 class="text-left">Description</h1>
                           <p>
                               {{$topic->description}}
                           </p>
                       </div>
                        <div class="mb-5">
                            <h1 class="text-left">Methodology</h1>
                            <p>
                                {{$topic->methodology}}
                            </p>
                        </div>
                        <div class="mb-5">
                            <h1 class="text-left">Deliverables</h1>
                            <p>
                                {{$topic->deliverables}}
                            </p>
                        </div>
                        <div class="mb-5">
                            <h1 class="text-left">Body</h1>
                            <p>
                                {{$topic->body}}
                            </p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <p>Created {{$topic->created_at->diffForHumans() .' by '. $topic->user->name}}</p>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
