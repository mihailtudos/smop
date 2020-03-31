@extends('partials.create')

@section('createCard')

    <h5 class="card-header">Create Diary Record</h5>

    <div class="card-body px-5">

        <form action="{{ route('diaries.store') }}" method="post">
            @csrf
            <div class="form-group ">
                <label for="title" class=" col-form-label text-md-right">Title<span class="text-danger">*</span></label>
                <div class="">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Indicative title" required autofocus>
                    <small id="emailHelp" class="form-text text-muted">Must be longer than 25 characters</small>

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group ">
                <label for="completed" class=" col-form-label text-md-right">Completed<span class="text-danger">*</span></label>

                <div class="">
                    <textarea id="description" class="form-control @error('completed') is-invalid @enderror" rows="5" name="completed"
                              placeholder="Field reserved for completed tasks." required >{{ old('completed') }}</textarea>
                    <small id="emailHelp" class="form-text text-muted">Must be between 150 - 1500 characters</small>

                    @error('completed')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group ">
                <label for="todo" class="col-form-label text-md-right">To do<span class="text-danger">*</span></label>

                <div class="">
                    <textarea id="todo"  class="form-control @error('todo') is-invalid @enderror" rows="5" name="todo"
                              placeholder="Field reserved for entering the outcome or feature plan." required >{{ old('todo') }}</textarea>
                    <small id="emailHelp" class="form-text text-muted">Must be between 150 - 1500 characters</small>

                    @error('todo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group ">
                <label for="notes" class="col-form-label text-md-right">Notes<span class="text-danger">*</span></label>

                <div class="">
                    <textarea id="notes" class="form-control @error('notes') is-invalid @enderror" rows="5" name="notes"
                              placeholder="Field reserved for additional notes." required >{{ old('notes') }}</textarea>
                    <small id="emailHelp" class="form-text text-muted">Must be between 150 - 1500 characters</small>

                    @error('notes')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0 ">
                <div class="col-md-8 offset-md-4 d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-primary">
                        Create
                    </button>
                    <a role="button" href="{{ route('diaries.index') }}" class="btn btn-secondary mr-2 text-white">
                        Cancel
                    </a>
                </div>
            </div>
        </form>

    </div>

@endsection
