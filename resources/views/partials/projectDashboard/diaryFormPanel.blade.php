
    @if( !$form->approved )
        <div class="jumbotron">
            <p>Ethical form not approved yet.</p>
        </div>
    @else
        <div class="d-flex justify-content-between border-secondary border-bottom border-top py-3">
            <div>
                <h3>Create new record</h3>
            </div>
            <div>
                <a class="btn btn-primary" href="{{ route('diaries.index') }}" role="button">View all</a>
            </div>
        </div>
        <div class="mt-4">
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


                @if($meetings != null)
                    <div class="form-group ">
                        <label for="meeting" class="col-form-label text-md-right">Meetings</label>

                        <div class="">
                            <select name="meeting" id="meeting" class="form-control @error('meeting') is-invalid @enderror input-lg">

                                @forelse($meetings as $meeting)
                                    <option value="">Select an available meeting</option>
                                    <option value="{{$meeting->id}}">{{'Meeting scheduled on '. $meeting->date  }}</option>
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
                            Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endif

