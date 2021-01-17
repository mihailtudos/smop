@forelse($meetings as $meeting)
    @if($meeting->accepted == null)
        @include('partials.meetings.unconfirmed')
    @elseif($meeting->accepted != null)
        @include('partials.meetings.confirmed')
    @endif
@empty
    <div class="p-4">
        <p>There are no upcoming meetings for you.</p>
    </div>
@endforelse


@if(isset($meeting))
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cancellation reason form</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('project.meeting.cancel', $meeting) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label for="reason">Cancellation reason<span class="text-danger">*</span></label>
                            <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason" placeholder="Enter the reason for cancellation" rows="7" required>{{ old('reason') }}</textarea>

                            @error('reason')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Cancel meeting</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
