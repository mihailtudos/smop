
    @if( !$form->approved )
        @if(auth()->user()->id == $form->user->projects->first()->supervisor->id or auth()->user()->hasRole('admin'))
            <div class="jumbotron ">
                <div class="d-flex justify-content-center">
                    <div>
                        <h4 class="mb-2 text-center">Approve <a href="{{$project->student->ethicalForm->path()}}">student ethical form</a></h4>
                    </div>
                </div>
                <form action="{{ route('student.ethic.form.approve', $form) }}" method="post">
                    @csrf

                    <div class="form-group d-flex justify-content-center">
                        <label for="approve" class=" col-form-label">Approve form<span class="text-danger">*</span></label>

                        <div class="col-lg-6">
                            <select name="approve" id="approve" class="custom-select" class="form-control @error('approve') is-invalid @enderror input-lg"  required>
                                <option value="">Select option</option>
                                <option value="1">Approve</option>
                            </select>

                            @error('approve')
                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-success" type="submit">Approve</button>
                        </div>
                    </div>
                </form>
                <div class="text-center">
                    <small>Student's ethical form was not approved yet, please access it and approve to be able to add meetings and tasks. </small>
                </div>
            </div>
        @endif
    @else
        @can('admin-supervise')
            {{--                        @include('partials.addTask')--}}


            <form action="{{ route('student.diaries.store') }}" method="post">
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

                {{--                                <div class="form-group ">--}}
                {{--                                    <label for="meeting" class="col-form-label text-md-right">Meetings</label>--}}

                {{--                                    <div class="">--}}
                {{--                                        <select name="meeting" id="meeting" class="form-control @error('meeting') is-invalid @enderror input-lg">--}}
                {{--                                            @forelse($meetings as $meeting)--}}
                {{--                                                <option value="{{$meeting->id}}">{{ $meeting->name }}</option>--}}
                {{--                                            @empty--}}
                {{--                                                <option value="">No meetings set</option>--}}
                {{--                                            @endforelse--}}
                {{--                                        </select>--}}
                {{--                                        <small id="emailHelp" class="form-text text-muted">You could link the diary record to an existing meeting. If desired meeting was not found <a href="{{ route('emails.create') }}"> contact </a> your supervisor.</small>--}}

                {{--                                        @error('meeting')--}}
                {{--                                        <span class="invalid-feedback" role="alert">--}}
                {{--                            <strong>{{ $message }}</strong>--}}
                {{--                        </span>--}}
                {{--                                        @enderror--}}

                {{--                                    </div>--}}
                {{--                                </div>--}}

                <div class="form-group row mb-0 ">
                    <div class="col-md-8 offset-md-4 d-flex flex-row-reverse">
                        <button type="submit" class="btn btn-primary">
                            Create
                        </button>
                    </div>
                </div>
            </form>
        @endcan
    @endif



