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

                    <form action="{{ route('admin.users.store') }}" method="post">
                            @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}<span class="text-danger">*</span></label>

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
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address<span class="text-danger">*</span></label>

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
                            <label for="degree" class="col-md-4 col-form-label text-md-right">Degree<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select name="degree" id="degree" class="custom-select" class="form-control @error('degree') is-invalid @enderror input-lg dynamic" data-dependent="degreeFields" onchange="fillDegreeFields()">
                                    <option value="">Select Study Field</option>
                                    @foreach($degrees as $degree)
                                        <option value="{{ $degree->id }}">{{$degree->name}}</option>
                                    @endforeach
                                </select>

                                @error('degree')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="degreeFields" class="col-md-4 col-form-label text-md-right">Fields<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select name="degreeFields[]" id="degreeFields" class="custom-select" class="form-control @error('degreeFields') is-invalid @enderror input-lg dynamic" required></select>

                                @error('degreeFields')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Role<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                @foreach($roles as $role)
                                    <div class="form-check">
                                        <input type="radio" name="role[]" value="{{ $role->id }}" @if($role->name === 'student') checked @endif>
                                        <label>{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row mb-0 ">
                            <div class="col-md-8 offset-md-4 d-flex flex-row-reverse">

                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                                <button type="button" onclick="window.history.back();" class="btn btn-secondary mr-2">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
