<div class="tab-pane fade @if(session()->has('upcoming')) active show @else  @endif" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class=" mt-4 jumbotron ">
        <h4>Here are shown all pending student's confirmation project meetings.</h4>
    </div>
    <div>
        <div class="row">
          @include('partials.meetings.upcomingMeetings')
        </div>
    </div>
</div>

