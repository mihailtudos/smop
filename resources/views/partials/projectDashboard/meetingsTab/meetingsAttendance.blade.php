<div class="tab-pane fade @if(session()->has('attendance')) show active @else  @endif" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    <div class=" mt-4 jumbotron">
        <h4>Here are shown all attended meetings as and outcome of a scheduled meeting.</h4>
    </div>
    <div>
        <div class="row">
            @forelse($completedMeetings as $meeting)
                @if($meeting->attended == 1)
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
                                <div class="form-group row mx-2 d-flex justify-content-between align-content-end ">
                                    <h3>Attended</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($meeting->attended == 0)
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
                                <div class="form-group row mx-2 d-flex justify-content-between align-content-end ">
                                    <h3>Not attended</h3>
                                </div>
                            </div>
                        </div>
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
