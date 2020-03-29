<div class="tab-pane fade @if(session()->has('attendance')) @else  @endif" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class=" mt-4 jumbotron ">
        <h4>Here are shown all pending student's confirmation project meetings.</h4>
    </div>
    <div>
        <div class="row">
            @forelse($meetings as $meeting)
                @if($meeting->attended == null)
                    <div class="col-12 mb-4">
                    <div class="card dashCardMini">
                        <div class="card-header">
                            <span class="mr-2 diaryIcon"><i class="fas fa-calendar-day"></i> {{ $meeting->date }}</span>
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
                                        <li><strong>Date and time :</strong> {{ $meeting->date }}</li>
                                            @if($meeting->accepted)
                                                <li><strong>Status :</strong> scheduled and confirmed {{ $meeting->date }}</li>
                                            @else
                                                <li><strong>Status :</strong> scheduled, awaiting student's accept</li>
                                            @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group row mx-2 d-flex justify-content-between align-content-end">

                                <div class="mt-2 float-left d-flex justify-content-between"><div class="pt-2">
                                        @if(now()->format('yy-m-d h:i') > $meeting->date)
                                            <form action="{{ route('project.meeting.attendance', $meeting->id) }}" method="post">
                                                @csrf
                                                @method('put')

                                                <div class="form-group d-flex justify-content-center">
                                                    <label for="supervisor" class=" col-form-label">Attendance<span class="text-danger">*</span></label>

                                                    <div class="col-lg-6">
                                                        <select name="attended" id="attended" class="custom-select" class="form-control @error('attended') is-invalid @enderror input-lg"  required>
                                                            <option value="">Select attendance option</option>
                                                            <option value="1">Attended</option>
                                                            <option value="0">Not attended</option>
                                                        </select>

                                                        @error('supervisor')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <button class="btn btn-success" type="submit">Assign</button>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    </div></div>
                                <div class="mt-2 float-left d-flex justify-content-between">
                                    <div class="p-2"><form action="{{ route('student.diaries.destroy', $meeting->id) }}" method="post">
                                            @csrf
                                            @method('delete')

                                            <button role="button" type="submit" class="btn btn-danger mr-2 px-1">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @else
                    <div class="jumbotron col-12 ">
                        <h4>No upcoming meetings found</h4>
                    </div>
                @endif
            @empty
                @can('student')
                    <p>No records found but you can create one at any time.</p>
                @endcan
            @endforelse
        </div>
    </div>
</div>
