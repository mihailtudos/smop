@extends('layouts.app')

@section('content')
    {{--Quick links--}}
    @include('partials.quick')

    <div class="row justify-content-center">

        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-end">
                    <span class="mr-2 diaryIcon"><h4><i class="fas fa-calendar-day"></i>  Record of {{ $diary->created_at->toDateString() }} </h4></span>
                    <div>
                        <a class="btn btn-success border-dark" href="{{ route('diaries.create') }}" role="button">Create</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                            <div class="col-12 mb-4">
                                <div class="card dashCardMini">

                                    @if($diary->meeting_id)
                                        <div class="card-header">
                                            <span class="mr-2 diaryIcon"> {{ substr( 'ref. to supervisory meeting of '. $diary->meeting->date, 0, -3) }} </span>
                                        </div>
                                    @endif

                                    <div class="card-body border-top border-successdashCardMini jumbotron">

                                        <div class="overflow-auto border-bottom border-dark mb-5">
                                            <h3>Title</h3>
                                            <h5 class="card-title mb-2 p-4">{{ $diary->title }}</h5>
                                        </div>
                                        <div class="overflow-auto border-bottom border-dark mb-5">
                                            <h3>Completed</h3>
                                            <h5 class="card-title mb-2 p-4">{{ $diary->completed }}</h5>
                                        </div>
                                        <div class="overflow-auto border-bottom border-dark mb-5">
                                            <h3>To do</h3>
                                            <h5 class="card-title mb-2 p-4">{{ $diary->todo }}</h5>
                                        </div>
                                        <div class="overflow-auto border-bottom border-dark mb-5">
                                            <h3>Title</h3>
                                            <h5 class="card-title mb-2 p-4">{{ $diary->title }}</h5>
                                        </div>
                                        <div class="form-group row mx-2 mt-5 d-flex justify-content-between">

                                            <div class="mt-2 float-left d-flex justify-content-between">
                                                @if($owner->id == auth()->user()->id)
                                                    <a href="{{ route('diaries.edit', $diary->id) }}" role="button" class="btn btn-secondary mr-2">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('diaries.destroy', $diary->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')

                                                        <button role="button" type="submit" class="btn btn-danger mr-2 px-1">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                            <div class="mt-2 float-right">
                                                <a href="{{ route('diaries.index') }}" class="btn btn-primary">Back</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
