@extends('layouts.app')
{{--{{dd($supervisors)}}--}}
@section('content')
    <div class="d-flex flex-row-reverse mb-4">
        <a class="btn btn-primary ml-3" href="{{ route('admin.') }}" role="button">Go to the dashboard</a>
    </div>

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Student</div>

                <div class="card-body">

                    <form action="{{ route('admin.users.store') }}" method="post">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="field1" class="col-md-4 col-form-label text-md-right">Field</label>

                            <div class="col-md-6">
                                <select class="custom-select" name="field1" id="field1" type="text">
                                    @foreach($fields as $field)

                                        <option value="{{ $field->id }}">{{$field->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="field1" class="col-md-4 col-form-label text-md-right">Field</label>

                            <div class="col-md-6">
                                <select class="custom-select" name="field1" id="field1" type="text">
                                    @foreach($supervisors as $supervisor)
                                        <option value="{{ $supervisor->id }}">{{$supervisor->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
