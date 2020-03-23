@extends('layouts.app')

@section('content')
    <div class="">
        @include('partials/breadcrumb')
    </div>
    <div class="container">


        <div class="row justify-content-center mb-4">
            <div class="col-md-3 mt-3 ">
                <!-- Side bar-cards -->
                @include('partials.sideMenu')

            </div>

            <div class="col-md-9">
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


    </div>



@endsection
