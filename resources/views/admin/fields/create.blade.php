@extends('partials.create')

@section('createCard')

    <h5 class="card-header">Create New Field</h5>

    <div class="card-body">

        <form action="{{ route('admin.fields.store') }}" method="post">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Course Name<span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required  autofocus>
                    <small id="emailHelp" class="form-text text-muted">The study field has to be unique (IT, Bussiness, etc) </small>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="degree" class="col-md-4 col-form-label text-md-right">Degree<span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <select name="degree" id="degree" class="custom-select" class="form-control @error('degree') is-invalid @enderror input-lg"  required>
                        <option value="">Select degree</option>
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



            <div class="form-group row mr-4 d-flex justify-content-end">
                <button type="button" onclick="window.history.back();" class="btn btn-secondary mr-2">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    Create
                </button>
            </div>
        </form>

    </div>

@endsection
