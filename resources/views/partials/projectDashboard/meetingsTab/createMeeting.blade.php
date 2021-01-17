<div class="tab-pane fade @if(session()->has('attendance') or session()->has('upcoming') or session()->has('cancelled')) @else show active @endif " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class=" mt-4 jumbotron">
        <h4>Here you can schedule new meetings by filling all below requirements.</h4>
    </div>
    <div class="mt-4">
        <form action="{{route('meetings.store', $project)}}" method="post" >
            @csrf
            <div class="form-group ">
                <label for="subject">Subject<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" id="subject" name="subject"  required autofocus placeholder="Meeting subject or reason">
                <small id="subject" class="form-text text-muted ">Shouldn't be longer than 250 characters</small>

                @error('subject')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="meeting_notes">Meeting notes<span class="text-danger">*</span></label>
                <textarea name="meeting_notes" class="form-control @error('meeting_notes') is-invalid @enderror" id="meeting_notes" required placeholder="Short meeting invitation notes">{{ old('meeting_notes') }}</textarea>
                <small id="meeting_notes" class="form-text text-muted">Send some short meeting related instructions</small>

                @error('meeting_notes')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" id="location" name="location"   placeholder="Indicate meeting location">
                <small id="title" class="form-text text-muted">Shouldn't be longer than 75 characters</small>

                @error('location')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>


            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date">Meeting date and time<span class="text-danger">*</span></label>
                        <input class="datepicker-here form-control @error('date') is-invalid @enderror" id="date" name="date" type="text" readonly="readonly" data-timepicker="true" data-date-format="yyyy-mm-dd"
                               data-time-format='hh:ii' data-language='en' data-position='top left' value="{{ old('date') }}" required>
                        <small id="date" class="form-text text-muted">Date and time should follow the following format yyyy-mm-dd hh:mm</small>

                        @error('date')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div>
                            <label>Form of meeting<span class="text-danger">*</span></label>

                            <div class="custom-control custom-radio">
                                <input type="radio" id="face-to-face" name="meeting_form" value="face-to-face" required>
                                <label for="face-to-face">face-to-face</label><br>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio" id="skype" name="meeting_form" value="skype">
                                <label for="skype">skype</label><br>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio" id="phone" name="meeting_form" value="phone">
                                <label for="phone">phone call</label><br>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio" id="other" name="meeting_form" value="other">
                                <label for="other">other - specified in nots section</label><br><br>
                            </div>
                        </div>

                        @error('meeting_form')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary float-right">Schedule meeting</button>
        </form>
    </div>
</div>
