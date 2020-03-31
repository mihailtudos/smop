<div class="tab-pane fade @if(session()->has('cancelled')) show active @else  @endif" id="nav-cancelled" role="tabpanel" aria-labelledby="nav-cancelled-tab">
    <div class=" mt-4 jumbotron">
        <h4>Here are shown all meetings that were cancelled and the cancellation reason.</h4>
    </div>
    <div>
        <div class="row">
            @forelse($cancelledMeetings as $meeting)
                @include('partials.meetings.cancelled')
            @empty
                <div class="p-4">
                    <p>No cancelled meetings found.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
