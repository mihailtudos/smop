@extends('layouts.app')

@section('content')
    {{--Quick links--}}
         @include('partials.quick')
    <div class="">
        <div class="">
            <div class="card dashCard">
                <div class="card-header text-center ">
                    <div>
                        <h4> {{$suggestion->title}} </h4>
                        <span class="text-left">
                            @if($suggestion->user->id == auth()->user()->id)
                            <a href="{{ route( 'suggestions.edit', $suggestion->id ) }}">
                                <button class="btn btn-primary " type="button">
                                    <h4 class="m-0 "><i class="fas fa-pen-nib"></i></h4>
                                </button>
                            </a>
                                @endif
                        </span>
                    </div>
                </div>
                <img class="card-img-top w-100" src="{{ '/storage/'.$suggestion->image }} "
                      alt="Card image cap">
                <div class="card-body">
                    <div class="text-justify jumbotron dashCard">
                       <div class="mb-5">
                           <h1 class="text-left">Description</h1>
                           <p>
                               {{$suggestion->description}}
                           </p>
                       </div>
                        <div class="mb-5">
                            <h1 class="text-left">Methodology</h1>
                            <p>
                                {{$suggestion->methodology}}
                            </p>
                        </div>
                        <div class="mb-5">
                            <h1 class="text-left">Deliverables</h1>
                            <p>
                                {{$suggestion->deliverables}}
                            </p>
                        </div>
                        <div class="mb-5">
                            <h1 class="text-left">Body</h1>
                            <p>
                                {{$suggestion->body}}
                            </p>
                        </div>
                        @if(auth()->user()->hasRole('student') and auth()->user()->topics->count() < 4)
                            <div class="d-flex justify-content-end">
                                <form action="{{ route('request.suggestion', $suggestion) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Request this project suggestion</button>
                                </form>
                            </div>
                        @endif
                    </div>
                    <div class=" container jumbotron dashCard">
                        <div class="row">
                            <div class="col-md-6">
                                <h1>Courses</h1>
                                @foreach($suggestion->fields as $field)
                                    <p class=""><a href="{{$field->pathToSuggestions()}}">{{$field->name}}</a></p>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <h1>Area of interests</h1>
                                @foreach($suggestion->subjects as $subject)
                                    <p class=""><a href="{{$subject->pathToSuggestions()}}">{{$subject->name}}</a></p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <p>Created {{$suggestion->created_at->diffForHumans() .' by '. $suggestion->user->name}}</p>
                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection
