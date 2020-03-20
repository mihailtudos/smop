@extends('layouts.app')

@section('content')
    {{--Quick links--}}
    @include('partials.quick')

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-end">
                    <h4>Your Project Suggestions</h4>
                    <div>
                        <a class="btn btn-secondary border-dark" href="{{ route('suggestions.create') }}" role="button" data-toggle="modal" data-target="#suggestionsModal">View all</a>
                        <a class="btn btn-success border-dark" href="{{ route('suggestions.create') }}" role="button">Create</a>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table ">
                        <thead class="thead-dark">
                        <tr class="text-center">
                            <th scope="col" class="text-center">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($suggestions as $suggestion)
                            <tr>
                                <td class="font-weight-bold"><a href="{{$suggestion->path()}}">{{ Str::limit($suggestion->title, '55') }}</a></td>
                                <td > {{ Str::limit($suggestion->description, '200') }} </td>
                                <td>
                                    <a  href="{{ route( 'suggestions.edit', $suggestion->id ) }}">
                                        <button class="btn btn-primary mr-2 mb-2 float-left float-left" type="button">
                                            <h4 class="m-0 ">
                                                <i class="fas fa-pen-nib"></i>
                                            </h4>
                                        </button>
                                    </a>
                                    <form action="{{ route('suggestions.destroy', $suggestion->id) }}" method="post" class="float-left">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route( 'suggestions.destroy', $suggestion->id ) }}">
                                            <button class="btn btn-danger " type="submit">
                                                <h4 class="m-0">
                                                    <i class="fas fa-eraser"></i>
                                                </h4>
                                            </button>
                                        </a>
                                    </form>

                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
    @include('partials.modalSuggestions')

@endsection
