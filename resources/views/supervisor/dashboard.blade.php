@extends('layouts.app')

@section('content')

    <div class="">
        @include('partials/breadcrumb')
    </div>

    <div class="container">



        <div class="row justify-content-center mb-4">
            <div class="col-md-3 ">
                <!-- Side bar-cards -->
                @include('partials.sideMenu')

            </div>

            <div class="col-md-9 mt-n3">
                <div class="card dashCard">
                    <div class="card-header font-weight-bold"><h4>Noticeboard</h4></div>
                    <div class="card-body">
                        <div class="row">
                            @forelse($posts = \App\Post::orderBy('created_at', 'desc')->paginate(3) as $post)
                                @include('partials.postCard')
                            @empty
                                <h4>No posts have been created yet</h4>
                            @endforelse

                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="col-md-9">
                <div class="card dashCard">
                    <div class="card-header">Last five projects created</div>
                    <div class="card-body">

                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Student</th>
                                <th scope="col">Supervisor</th>
                                <th scope="col">Handle</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse(auth()->user()->monitoredProjects as $project)
                                <tr>
                                    <th scope="row"> {{$project->title}}</th>
                                    <td>{{ $project->student->name }}</td>
                                    <td>{{ $project->supervisor->name }}</td>
                                    <td><a href="{{$project->path()}}" role="button" class="btn btn-success" ><i class="fas fa-sign-out-alt"></i></a></td>
                                </tr>
                            @empty
                                <p>No projects yet</p>
                            @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
