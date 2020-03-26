
<div class="col-lg-4">
    <div class="">
        <div class="card dashCard">
                <div class="card-header d-flex justify-content-between align-items-end">
                    <h4>Create meetings</h4>
                </div>
                <div class="card-body">

                </div>
            </div>
    </div>

    <div>
        @include('partials.projectDashboard.addTaskCard')
    </div>

{{--    TASKS history card--}}
    <div>
        <div class="mt-4">
            <div class="card dashCard">
                <div class="card-header d-flex justify-content-between mt-n2">
                    <h4>Project activity </h4>
                </div>
                <div class="card-body">
                    <div>
                        <table class="table text-center">
                            <thead>
                            <tr >
                                <th scope="col">Latest</th>
                                <th scope="col">Task</th>
                            </tr>
                            </thead>
                            @if($tasks != null)
                            <tbody>
                                @foreach($tasks as $task)
                                    @if(!$task->completed)
                                        <tr>
                                            <th scope="row">{{   $task->created_at->format('d-m-yy') }}</th>
                                            <td> {{  'the '}} <strong class="text-danger">supervisor</strong> {{' created task no.'. $task->id}} </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th scope="row">{{   $task->created_at->format('d-m-yy') }}</th>
                                            <td> {{  'the '}} <strong class="text-danger">supervisor</strong> {{' created task no.'. $task->id}} </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{   $task->updated_at->format('d-m-yy') }}</th>
                                            <td> {{  'the '}} <strong class="text-primary">student</strong> {{' completed task no.'. $task->id}} </td>
                                        </tr>
                                    @endif

                                @endforeach

                            @else
                                No tasks added to this project yet

                            </tbody>
                                <div class="d-flex justify-content-center">
                                    {{ $tasks->links() }}
                                </div>
                            @endif
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="col-lg-8">
    <div class="">
        <div class="card dashCard">
            <div class="card-header d-flex justify-content-between mt-n2">
                <h4>Project Supervisor Agenda</h4>
            </div>
            <div class="card-body ">

                <div >
                    <nav class="d-flex justify-content-center mb-3">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link  text-dark font-weight-bold active" id="nav-tasks-tab" data-toggle="tab" href="#nav-tasks" role="tab" aria-controls="nav-tasks" aria-selected="false">Tasks backlog</a>
                            <a class="nav-item nav-link text-dark font-weight-bold " id="nav-form-tab" data-toggle="tab" href="#nav-form" role="tab" aria-controls="nav-form" aria-selected="true">Diary form</a>
                            <a class="nav-item nav-link text-dark font-weight-bold" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="false">Project details</a>
                        </div>
                    </nav>
                    <div class="tab-content p-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-tasks" role="tabpanel" aria-labelledby="nav-tasks-tab">
                            @if($form->approved)
                                @include('partials.projectDashboard.tasksPanel')
                            @endif
                        </div>
                        <div class="tab-pane fade " id="nav-form" role="tabpanel" aria-labelledby="nav-form-tab">
                            @include('partials.projectDashboard.diaryForm')
                        </div>
                        <div class="tab-pane fade" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
                            @include('partials.projectDashboard.projectDetails')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>




