<div class="card p-3 mb-3 border-bottom border-success">
    <div>
        <h4><span class="text-success"># </span>{{'SMOP-mt0'.$task->id}}</h4>
        <h4>{{$task->title}}</h4>
    </div>
    <div>
        <input class="w-100 form-control form-control-lg " type="text" name="" id="" value="{{$task->description}}" disabled>
    </div>
    @if(auth()->user()->id == $project->student->id and $task->completed == 0)
        <div class=" mt-5 border-success border-top">
            <form class="d-flex justify-content-end" id="competeTask" action="{{route('projects.tasks.complete', [$project, $task])}}" method="post">
                @csrf
                @method('put')
                <div class="mt-3">
                    <div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" onchange="$('#competeTask').submit();" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Complete</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @elseif($task->completed == 1)
        <div class="d-flex justify-content-end mt-5 border-success border-top">
            <p class="pt-3 mb-0">This task was completed on {{$task->updated_at->diffForHumans()}}</p>
        </div>
    @else
        <div class="d-flex justify-content-end mt-5 border-success border-top">
            <p class="pt-3 mb-0">Awaiting student completion</p>
        </div>
    @endif
</div>
