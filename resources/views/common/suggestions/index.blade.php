@extends('layouts.app')

@section('content')
    {{--Quick links--}}
    @include('partials.quick')

    <div class="row justify-content-center">

        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-end">
                    <h4>{{$field->name }} suggestion</h4>
                </div>
                <div class="card-body">

                    <div class="row">
                        @forelse($suggestions as $suggestion)
                            <div class="col-xl-6 mb-4">
                                <div class="card dashCardMini">
                                    <div class="card-body border-top border-success ">
                                        <div class="overflow-auto border-bottom border-dark" style="height: 125px">
                                            <h5 class="card-title mb-2">{{ Str::limit($suggestion->title, '150') }}</h5>
                                        </div>
                                        <div class="mt-2 float-right">
                                            <a href="{{$suggestion->path()}}" class="btn btn-primary">Read mode...</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
