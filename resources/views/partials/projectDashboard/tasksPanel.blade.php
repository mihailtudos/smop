<div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item text-dark font-weight-bold nav-link active" id="nav-incomplete-tab" data-toggle="tab" href="#nav-incomplete" role="tab" aria-controls="nav-incomplete" aria-selected="true">Incomplete</a>
            <a class="nav-item text-dark font-weight-bold nav-link" id="nav-completed-tab" data-toggle="tab" href="#nav-completed" role="tab" aria-controls="nav-completed" aria-selected="false">Completed</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-incomplete" role="tabpanel" aria-labelledby="nav-incomplete-tab">
            <div class="mt-4">
                @forelse($incompletedTasks as $task)
                        @include('partials.tasks.tasksCard')
                @empty
                    <h4>There are no tasks assigned to this project.</h4>
                @endforelse
            </div>
        </div>
        <div class="tab-pane fade" id="nav-completed" role="tabpanel" aria-labelledby="nav-completed-tab">
            <div class="mt-4">
                @forelse($completedTasks as $task)
                        @include('partials.tasks.completedTasksCard')
                @empty
                    <h4>There are no tasks assigned to this project.</h4>
                @endforelse
            </div>
        </div>
    </div>
</div>
