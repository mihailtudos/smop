<div class="tab-pane fade @if(session()->has('attendance')) show active @else  @endif" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    <div class=" mt-4 jumbotron">
        <h4>Here are shown all attended meetings as and outcome of a scheduled meeting.</h4>
    </div>
    <div>
        <div class="row">
            @forelse($completedMeetings as $meeting)
                @include('partials.meetings.attendanceCard')
            @empty
                <div class="p-4">
                    <p>No attended meetings found.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
