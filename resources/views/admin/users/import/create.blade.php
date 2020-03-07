@extends('layouts.app')

@section('content')
    {{--Quick links--}}
    @include('partials.quick')

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Create user</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.users.import.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        {{--<div class="input-group my-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="file">Xcell File</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file_input" aria-describedby="file">
                                <label class="custom-file-label" for="file_input">Choose file</label>
                            </div>
                        </div>--}}


                        <div class="form-group row">
                            <label for="file"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Xcell File') }}</label>

                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control @error('file') is-invalid @enderror"
                                       name="file" required autofocus>

                                @error('file')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @include('partials.errors')

                        <div class="form-group row mb-0 ">
                            <div class="col-md-8 offset-md-4 d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-primary">
                                    Upload
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
