<div>
    @forelse($tasks as $task)
        @if($task->completed)
        @else
            <div class="card p-3 mb-3 border-bottom border-success">
                <div>
                    <h1>{{'#'.$task->id}}</h1><h4>{{$task->title}}</h4>
                </div>
                <form class="d-flex justify-content-between align-items-center" action="">
                    <input class="w-100 form-control form-control-lg " type="text" name="" id="" value="{{$task->description}}" disabled>
                </form>
                <div class="d-flex align-content-end justify-content-end mt-5 border-success border-top">
                    <p class="mt-2">Awaiting student completion</p>
                </div>
            </div>
            @endif
    @empty
        <h4>No projects found</h4>
    @endforelse
</div>
