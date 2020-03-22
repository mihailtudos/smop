@extends('layouts.app')

@section('content')
    {{--Quick links--}}
    @include('partials.quick')

    <div class="row justify-content-center">

        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-end">
                    <h4>Your Diary Records</h4>
                    <div>
                        <a class="btn btn-success border-dark" href="{{ route('student.diaries.create') }}" role="button">Create</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($records as $record)
                            <div class="col-xl-6 mb-4">
                                <div class="card dashCardMini">
                                    <div class="card-header">
                                        <span class="mr-2 diaryIcon"><i class="fas fa-calendar-day"></i> {{ $record->created_at->toDateString() }}</span>
                                    </div>
                                    <div class="card-body border-top border-success ">
                                        <div class="overflow-auto border-bottom border-dark" style="height: 150px">
                                            <h5 class="card-title mb-2">{{ Str::limit($record->title, '150') }}</h5>
                                        </div>
                                        <div class="form-group row mx-2 d-flex justify-content-between">
                                            <div class="mt-2 float-left">
                                                <a href="{{ route('student.diaries.edit', $record->id) }}" role="button" class="btn btn-secondary mr-2">
                                                    Edit
                                                </a>
                                            </div>

                                            <div class="mt-2 float-right">
                                                <a href="{{$record->path()}}" class="btn btn-primary">Mode details...</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            @can('student')
                                <p>No records found but you can create one at any time.</p>
                            @endcan
                        @endforelse
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
