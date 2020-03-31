<div class="col-12 mb-4">
    <div class="card dashCardMini">
        <div class="card-header">
            <span class="mr-2 diaryIcon"><i class="fas fa-calendar-day"></i> {{ substr($meeting->date, 0, -3) }}</span>
        </div>
        <div class="card-body border-top border-success ">
            <div class="overflow-auto border-bottom border-dark" >
                <div class=" p-2 mb-1">
                    <h4>Subject</h4>
                    <h5 class="card-title mx-2 ">{{ $meeting->subject }}</h5>
                </div>
                <div class="mb-1 p-2">
                    <h4>Message</h4>
                    <p class="card-title mx-2">{{ $meeting->meeting_notes }}</p>
                </div>
                <div class="mb-1 p-2">
                    <h5>Meeting details</h5>
                    <ul>
                        @if($meeting->meeting_form == 'other')
                            <li><strong>Meeting type :</strong> location specified in the notes </li>
                        @else
                            <li><strong>Meeting type :</strong> {{ $meeting->meeting_form }} </li>
                        @endif
                        <li><strong>Location :</strong> {{ $meeting->location }}</li>
                        <li><strong>Date and time :</strong> {{ substr($meeting->date, 0, -3) }}</li>
                        @if($meeting->accepted)
                            <li><strong>Status :</strong> scheduled and confirmed {{ substr($meeting->date, 0, -3) }}</li>
                        @else
                            <li><strong>Status :</strong> scheduled, awaiting confirmation</li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="mt-2 pt-2">
                <div class="d-flex justify-content-end">

                    @if(now()->format('yy-m-d h:i') < $meeting->date)
                        @if((new DateTime('+25 hours'))->format('yy-m-d h:i') < $meeting->date)
                            <button type="button" class="btn btn-danger mr-2 px-1" data-toggle="modal" data-target="#staticBackdrop">
                                Cancel
                            </button>
                        @else
                            <div >
                                <p>Is too late to cancel this meeting. Please, make sure @if(auth()->user()->id == $project->student->id) the supervisor @else the student @endif is informed about you being unable to attend the meeting.</p>
                            </div>
                        @endif
                    @else
                        @if( (auth()->user()->id == $project->supervisor->id or auth()->user()->hasRole('admin')))
                            <div>
                                <form action="{{ route('project.meeting.attendance', $meeting->id) }}" method="post">
                                    @csrf
                                    @method('put')

                                    <div class="form-group d-flex justify-content-between ">
                                        <label for="supervisor" class=" col-form-label mr-2">Attendance<span class="text-danger">*</span></label>
                                        <select  name="attended" id="attended" class="custom-select" class="form-control @error('attended') is-invalid @enderror input-lg"  required>
                                            <option value="">Select option</option>
                                            <option value="1">Attended</option>
                                            <option value="0">Not attended</option>
                                        </select>

                                        @error('supervisor')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror

                                        <div class="ml-2">
                                            <button class="btn btn-success" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            You missed this meeting, the supervisor will conduct the attendance accordingly .
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
