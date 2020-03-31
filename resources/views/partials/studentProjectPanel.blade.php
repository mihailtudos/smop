<div class="col-lg-8">
    <div class="">
        <div class="card dashCard">
            <div class="card-header d-flex justify-content-between mt-n2">
                <h4>Project Student Agenda</h4>
            </div>
            <div class="card-body ">

                <div >
                    <nav class="d-flex justify-content-center mb-3">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link  text-dark font-weight-bold @if(session()->has('meeting') or session()->has('form') or session()->has('attendance') or session()->has('form') or session()->has('upcoming'))   @else active @endif " id="nav-tasks-tab" data-toggle="tab" href="#nav-tasks" role="tab" aria-controls="nav-tasks" aria-selected="false">Tasks</a>
                            <a class="nav-item nav-link text-dark font-weight-bold @if(session()->has('form'))  active  @else @endif" id="nav-form-tab" data-toggle="tab" href="#nav-form" role="tab" aria-controls="nav-form" aria-selected="true">Diary form</a>
                            <a class="nav-item nav-link text-dark font-weight-bold @if(session()->has('meeting') or session()->has('attendance') or session()->has('upcoming')) active  @else  @endif" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="false">Meetings</a>
                            <a class="nav-item nav-link text-dark font-weight-bold" id="nav-activity-tab" data-toggle="tab" href="#nav-activity" role="tab" aria-controls="nav-activity" aria-selected="false">Activity</a>
                        </div>
                    </nav>
                    <div class="tab-content p-3" id="nav-tabContent">
                        <div class="tab-pane fade @if(session()->has('meeting') or session()->has('form') or session()->has('attendance') or session()->has('upcoming'))  @else show active @endif" id="nav-tasks" role="tabpanel" aria-labelledby="nav-tasks-tab">
                            @if($form != null )
                                @if($form->approved)
                                    @include('partials.projectDashboard.tasksPanel')
                                @else
                                    <div class="jumbotron text-center">
                                        <p>Before project kick out there must be an ethical form submitted and approved.</p>
                                    </div>
                                @endif
                            @else
                                <div class="jumbotron text-center">
                                    <p>{{$project->student->name}} doesn't have an ethical form submited and approved</p>
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane fade @if(session()->has('form')) show active  @else @endif" id="nav-form" role="tabpanel" aria-labelledby="nav-form-tab">
                            @if($form != null)
                                @include('partials.projectDashboard.diaryFormPanel')
                            @endif
                        </div>
                        <div class="tab-pane fade @if(session()->has('meeting') or session()->has('attendance') or session()->has('upcoming')) show active  @else @endif" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
                            @include('partials.projectDashboard.createMeetingPanel')
                        </div>
                        <div class="tab-pane fade" id="nav-activity" role="tabpanel" aria-labelledby="nav-activity-tab">
                            @include('partials.projectDashboard.projectActivityPanel')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="col-lg-4">
    @if(!auth()->user()->hasRole('student'))
    <div class="mb-5">
        @include('partials.projectDashboard.addTaskCard')
    </div>
    @endif
    <div>
        @include('partials.projectDashboard.projectDetailsCard')
    </div>
</div>


