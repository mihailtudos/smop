@extends('layouts.app')

@section('content')
    <div class="container">
    @include('partials.quick')


            <section id="team" class="pb-5">
                    <div class="row justify-content-center">
                        @forelse($projects as $project)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                                <div class="mainflip">
                                    <div class="frontside">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <p class="studentIcon"><i class="fas fa-user-graduate"></i></p>
                                                <h4 class="card-title">
                                                    {{$project->student->name}}
                                                </h4>
                                                <p class="card-text">
                                                    {{ Str::limit($project->title, 145)}}
                                                </p>
                                                <div class="align-self-end">
                                                    <a href="{{$project->path()}}" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-arrow-alt-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="backside ">
                                        <div class="card">
                                            <div class="card-body text-center mt-4">
                                                @if($project->description)
                                                    <p class="card-text">
                                                        {{ Str::limit($project->description, 350)}}
                                                    </p>
                                                    @else
                                                        <p class="card-text">No description found for this project. However, if a short description is needed please contact your coordinator.</p>
                                                    @endif

                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <a class="social-icon text-xs-center"  href="{{$project->path()}}">
                                                            <i class="fa fa-arrow-alt-circle-right"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                                <div class="col-md-8 ">
                                    <div class="card">
                                        <div class="card-header">Monitored Projects</div>
                                        <div class="card-body">
                                            <h2>No projects found, please <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">contact</button> your admin</h2>
                                        </div>
                                    </div>
                                </div>
                        @endforelse

                    </div>
            </section>


    </div>
    @include('partials.modalMessage')
@endsection
