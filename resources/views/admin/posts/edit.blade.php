@extends('layouts.app')

@section('content')
{{--Quick links--}}
    @include('partials.quick')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card dashCard">
                <div class="card-header">
                    <h4>Create post</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.posts.update', $post) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">Title<span class="text-danger">*</span></label>

                            <div class="col-md-10">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{old('title', $post->title)}}" required autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">Description<span class="text-danger">*</span></label>

                            <div class="col-md-10">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{old('title', $post->description)}}" required autofocus>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="body" class="col-md-2 col-form-label text-md-right">Body<span class="text-danger">*</span></label>

                            <div class="col-md-10">
                                <textarea class="form-control @error('body') is-invalid @enderror"  name="body" id="body" cols="20" rows="10"  required autofocus>{{old('title', $post->body)}}</textarea>

                                @error('body')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0 ">
                            <div class="col-md-8 offset-md-4 d-flex flex-row-reverse">

                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <a role="button" href="{{ route('admin.posts.index') }}" class="btn btn-secondary mr-2">
                                    Cancel
                                </a>

                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
