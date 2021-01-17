@extends('partials.create')

@section('createCard')

    <h5 class="card-header">Create Diary Record</h5>

    <div class="card-body px-5">

        <form action="{{ route('diaries.update', $diary) }}" method="post">
            @csrf
           @method('PUT')

            <div class="form-group ">
                <label for="title" class=" col-form-label text-md-right">Title<span class="text-danger">*</span></label>
                <div class="">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $diary->title) }}" placeholder="Indicative title" required >
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
                    <textarea id="completed" class="form-control @error('completed') is-invalid @enderror" rows="5" name="completed"
                              placeholder="Field reserved for completed tasks." required >{{ old('title', $diary->completed) }}</textarea>
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
                              placeholder="Field reserved for entering the outcome or feature plan." required >{{ old('title', $diary->todo) }}</textarea>
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
                              placeholder="Field reserved for additional notes." required >{{ old('title', $diary->notes) }}</textarea>
                    <small id="emailHelp" class="form-text text-muted">Must be between 150 - 1500 characters</small>

                    @error('notes')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            @if($diary->meeting_id)
                <div class="form-group ">
                    <label for="meeting" class="col-form-label text-md-right">Meetings</label>
                    <div class="">
                        <select name="meeting_id" id="meeting" class="form-control @error('meeting') is-invalid @enderror input-lg" >
                            @forelse($meetings as $meeting)
                                <option @if($meeting->id == $diary->meeting_id) selected @endif  value="{{$meeting->id}}">{{'meeting of form: ' .$meeting->meeting_form .' from: '. substr(  $meeting->date, 0, -3) }}</option>
                            @empty
                                <option value="">No meetings set</option>
                            @endforelse
                        </select>
                        <small id="emailHelp" class="form-text text-muted">You could link the diary record to an existing meeting. If desired meeting was not found <a href="{{ route('emails.create') }}"> contact </a> your supervisor.</small>

                        @error('meeting')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            @endif

            <div class="form-group row mb-0 ">
                <div class="col-md-8 offset-md-4 d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                    <a role="button" href="{{ route('diaries.index') }}" class="btn btn-secondary mr-2 text-white">
                        Cancel
                    </a>
                </div>
            </div>
        </form>

    </div>

@endsection
