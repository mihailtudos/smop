@extends('partials.create')

@section('createCard')

    <h5 class="card-header">Create New Field</h5>

    <div class="card-body">

        <form action="{{ route('admin.subjects.update', $subject) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Subject Name<span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $subject->name }}" required  autofocus>
                    <small id="emailHelp" class="form-text text-muted">The subject field has to be unique (Networking, Cyber Security, etc.). </small>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="fields" class="col-md-4 col-form-label text-md-right">Fields<span class="text-danger">*</span></label>

                <div class="col-md-6 mt-2">
                    @foreach($fields as $field)
                        <div class="form-check">
                            <input type="checkbox" name="fields[]" value="{{ $field->id }}" @if($subject->fields->pluck('id')->contains($field->id)) checked @endif>
                            <label>{{ $field->name }}</label>
                        </div>
                    @endforeach

                        @error('fields')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
            </div>



            <div class="form-group row mr-4 d-flex justify-content-end">
                <a role="button" href=" {{ route('admin.subjects.index') }}" class="btn btn-secondary mr-2">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    Update
                </button>

            </div>
        </form>

    </div>

@endsection
