@extends('partials.create')

@section('createCard')

    <h5 class="card-header">Create New Field</h5>

    <div class="card-body">

        <form action="{{ route('admin.users.store') }}" method="post">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Name<span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required  autofocus>

                    @error('name')
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
                        @foreach(\App\Level::all() as $level)

                            <option value="{{ $level->id }}">{{$level->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="field1" class="col-md-4 col-form-label text-md-right">Field</label>

                <div class="col-md-6">
                    <select class="custom-select" name="field1" id="field1" type="text">
                        @foreach(\App\User::all() as $supervisor)
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

@endsection
