@extends('layouts.app')

@section('content')
    {{--Quick links--}}
         @include('partials.quick')
    <div class="">
        <div class="">
            <div class="card dashCard">
                <div class="card-header d-flex justify-content-center align-content-center">
                    <div class="">
                        <h3> {{$topic->title}} </h3>
                    </div>
                    @if(auth()->user()->hasRole('admin') or $topic->user->id == auth()->user()->id)
                        <div class="ml-4">
                            <a role="button" href="{{ route( 'student.topics.edit', $topic->id ) }}">
                                <h4 class="mt-1">
                                    <i class="fas fa-pen-nib text-warning"></i>
                                </h4>
                            </a>
                        </div>
                    @endif
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
                        <p>Created {{$topic->created_at->diffForHumans() .' by '}} <strong><a href="{{ $topic->user->path() }}">{{ $topic->user->name }}</a></strong></p>
                    </div>
                    @if(auth()->user()->hasRole('admin'))



                        <div class="jumbotron">
                            <div class="d-flex justify-content-center">
                                <h3 class="mb-5 text-center">Assign supervisor to the topic proposed by the student</h3>
                            </div>

                                <form action="{{ route('admin.projects.assign', $topic) }}" method="post">
                                    @csrf

                                    <div class="form-group d-flex justify-content-center">
                                        <label for="supervisor" class=" col-form-label">Supervisor<span class="text-danger">*</span></label>

                                        <div class="col-lg-6">
                                            <select name="supervisor" id="supervisor" class="custom-select" class="form-control @error('supervisor') is-invalid @enderror input-lg"  required>
                                                <option value="">Select supervisor</option>
                                                @foreach($topic->subjects->first()->profiles as $supervisor)
                                                    <option value="{{ $supervisor->user->id }}">{{$supervisor->user->name}}</option>
                                                @endforeach
                                            </select>

                                            @error('supervisor')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div>
                                            <button class="btn btn-success" type="submit">Assign</button>
                                        </div>
                                    </div>

                                </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>


    </div>
@endsection
