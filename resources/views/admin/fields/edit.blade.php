@extends('partials.create')

@section('createCard')

    <h5 class="card-header">Create New Field</h5>

    <div class="card-body">

        <form action="{{ route('admin.fields.update', $field) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Field Name<span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $field->name }}" required  autofocus>
                    <small id="emailHelp" class="form-text text-muted">The study field has to be unique (IT, Bussiness, etc) </small>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="level" class="col-md-4 col-form-label text-md-right">Degree levels<span class="text-danger">*</span></label>

                <div class="col-md-6 mt-2">
                    @foreach($levels as $level)
                        <div class="form-check">
                            <input type="checkbox" name="levels[]" value="{{ $level->id }}" @if($field->levels->pluck('id')->contains($level->id)) checked @endif>
                            <label>{{ $level->name }}</label>
                        </div>
                    @endforeach

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
            </div>



            <div class="form-group row mr-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
            </div>
        </form>

    </div>

@endsection
