@extends('partials.create')

@section('createCard')

    <h5 class="card-header">Edit Course</h5>

    <div class="card-body">

        <form action="{{ route('admin.fields.update', $field) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Course Name<span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $field->name) }}" required  autofocus>
                    <small id="emailHelp" class="form-text text-muted">The study field has to be unique (Computer Science, Business, etc.). </small>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="level_id" class="col-md-4 col-form-label text-md-right">Degree levels<span class="text-danger">*</span></label>

                <div class="col-md-6 mt-2">
                    @foreach($degrees as $degree)
                        <div class="form-check">
                            <input type="radio" name="level_id" value="{{ $degree->id }}" @if($degree->fields->pluck('id')->contains($degree->id)) checked @endif required>
                            <label>{{ $degree->name }}</label>
                        </div>
                    @endforeach

                        @error('degree')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
            </div>



            <div class="form-group row mr-4 d-flex justify-content-end">
                <a role="button" href="{{ route('admin.fields.index') }}" class="btn btn-secondary mr-2">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    Update
                </button>

            </div>
        </form>

    </div>

@endsection
