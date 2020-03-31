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


