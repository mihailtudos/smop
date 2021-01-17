
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Schedule meeting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="{{route('meetings.store', $project)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Task<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" id="title" name="title"  required autofocus placeholder="Task title">
                            <small id="title" class="form-text text-muted">Shouldn't be longer than 250 characters</small>

                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="location">Location<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" id="location" name="location"  required autofocus placeholder="Indicate meeting location">
                            <small id="title" class="form-text text-muted">Shouldn't be longer than 75 characters</small>

                            @error('location')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">

                            <label for="time">Meeting time<span class="text-danger">*</span></label>
                            <input name="time" type="text"
                                   data-timepicker="true" data-time-format='hh:ii aa'
                                   class="datepicker-here form-control"
                                   data-language='en'

                                   data-position='top left'/>
                            <small id="time" class="form-text text-muted">dd/mm/yyyy</small>

                            @error('time')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="notes">Meeting notes<span class="text-danger">*</span></label>
                            <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" id="notes" required placeholder="Short meeting invitation notes">{{ old('notes') }}</textarea>
                            <small id="notes" class="form-text text-muted">Send some short meeting related instructions</small>

                            @error('notes')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Schedule meeting</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
