<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link text-dark font-weight-bold @if(session()->has('attendance') or session()->has('upcoming')) @else active @endif " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Schedule</a>
        <a class="nav-item nav-link text-dark font-weight-bold @if(session()->has('upcoming')) active @else  @endif" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Upcoming</a>
        <a class="nav-item nav-link text-dark font-weight-bold @if(session()->has('attendance')) active @else  @endif" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Attendance</a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    @include('partials.projectDashboard.meetingsTab.createMeeting')
    @include('partials.projectDashboard.meetingsTab.upcomingMeetings')
    @include('partials.projectDashboard.meetingsTab.meetingsAttendance')
</div>


@if(isset($meeting))
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('meetings.destroy', [$project, $meeting]) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label for="reason">Cancellation reason</label>
                            <textarea class="form-control  @error('reason') is-invalid @enderror" id="reason" placeholder="Enter the reason for cancellation" required>{{ old('reason') }}</textarea>
                            @error('reason')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Understood</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
