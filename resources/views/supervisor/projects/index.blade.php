@extends('layouts.app')

@section('content')

    <div class="container">
    @include('partials.quick')

        <div class="row justify-content-center mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold"><h4>Supervised projects</h4></div>
                    <div class="card-body">

                        <div class="row">
                            @forelse($projects as $project)
                                <div class="col-md-6">
                                    <a class="text-decoration-none" href="{{$project->path()}}">
                                        <div class="card overflow-hidden" style="height: 250px">
                                            <h5 class="card-header @if($project->completed) card-header-completed @endif "><i class="fas fa-user-graduate"></i> {{ $project->student->name}}</h5>
                                            <div class="card-body">
                                                <h5 class="card-title "> {{ Str::limit($project->title , 200)}}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between container border-top border-dark">
                                                <p class="m-0">Status: @if($project->completed) completed @else in progress @endif</p>
                                                <p class="m-0">Created at: {{$project->created_at->diffForHumans()}}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <h4>No projects found, please <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">contact</button>
                                    your coordinator to create one </h4>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.modalMessage')
@endsection
