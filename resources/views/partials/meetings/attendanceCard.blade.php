<div class="col-12 mb-4">
    <div class="card dashCardMini">
        <div class="card-header">
            <span class="mr-2 diaryIcon"><i class="fas fa-calendar-day"></i> {{ substr($meeting->date, 0, -3) }}</span>
        </div>
        <div class="card-body border-top border-success ">
            <div class="overflow-auto border-bottom border-dark" >
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
                            <li><strong>Status :</strong> scheduled and confirmed on {{ substr($meeting->date, 0, -3) }}</li>
                        @else
                            <li><strong>Status :</strong> scheduled, but not confirmed</li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="form-group m-0 pt-2 d-flex justify-content-end ">
                @if($meeting->attended)
                    <h3>Attended</h3>
                @else
                    <h3>Not attended</h3>
                @endif
            </div>
        </div>
    </div>
</div>


