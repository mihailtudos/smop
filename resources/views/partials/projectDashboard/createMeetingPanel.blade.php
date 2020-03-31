<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link text-dark font-weight-bold @if(session()->has('attendance') or session()->has('upcoming') or session()->has('cancelled')) @else active @endif " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Schedule</a>
        <a class="nav-item nav-link text-dark font-weight-bold @if(session()->has('upcoming')) active @else  @endif" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Upcoming</a>
        <a class="nav-item nav-link text-dark font-weight-bold @if(session()->has('attendance')) active @else  @endif" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Attendance</a>
        <a class="nav-item nav-link text-dark font-weight-bold @if(session()->has('cancelled')) active @else  @endif" id="nav-cancelled-tab" data-toggle="tab" href="#nav-cancelled" role="tab" aria-controls="nav-cancelled" aria-selected="false">Cancelled</a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    @include('partials.projectDashboard.meetingsTab.createMeeting')
    @include('partials.projectDashboard.meetingsTab.upcomingMeetings')
    @include('partials.projectDashboard.meetingsTab.meetingsAttendance')
    @include('partials.projectDashboard.meetingsTab.cancelledMeetings')
</div>



