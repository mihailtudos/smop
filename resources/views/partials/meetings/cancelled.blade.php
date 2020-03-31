<div class="col-12 mb-4">
    <div class="card dashCardMini">
        <div class="card-header bg-danger">
            <span class="mr-2 diaryIcon"><i class="fas fa-calendar-day"></i> {{ substr($meeting->date, 0, -3) }}</span>
        </div>
        <div class="card-body border-top border-success">
            <div class="overflow-auto border-bottom border-dark" >
                <div class="mb-1 p-2">
                    <h4>Message</h4>
                    <p class="card-title mx-2">{{ $meeting->reason }}</p>
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
                    </ul>
                </div>
            </div>
            <div class="mt-2 pt-2">
                <div class="d-flex justify-content-end">
                    <p>Meeting cancelled on {{$meeting->deleted_at->format('Y-m-d') .' by '. $meeting->cancelled_by}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
