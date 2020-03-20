@extends('partials.create')

@section('createCard')

    <h5 class="card-header">Edit Study Degree Level</h5>

    <div class="card-body">

        <form action="{{ route('admin.levels.update', $level) }}" method="post">

            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Name<span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $level->name }}" required autofocus>
                    <small id="emailHelp" class="form-text text-muted">The study level has to be unique (BSc, MSc, etc) </small>

                    @error('name')
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
                        Update
                    </button>
            </div>
        </form>

    </div>

@endsection
