@extends('layouts.app')

@section('content')
    {{--Quick links--}}
    @include('partials.quick')
    <div class="row">

        <div class="col-lg-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-end">
                    <h4>Projects task backlog</h4>
                </div>
                <div class="card-body">
                @can('manage-projects')
                    @include('partials.addTask')
                @endcan
                    @forelse($project->tasks as $task)
                        <div class="card p-2">
                            <form class="d-flex justify-content-between align-items-center" action="">
                                <input class="w-100 form-control form-control-lg" type="text" name="" id="" value="{{$task->title}}" @cannot('manage-projects') disabled @endcannot>
                                <input class="mx-3" type="checkbox" name="" id="">
                            </form>
                        </div>

                    @empty
                        <h4>No projects found</h4>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-end">
                    <h4>Activity</h4>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
@endsection
