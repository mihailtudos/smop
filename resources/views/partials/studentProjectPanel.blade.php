@forelse($project->tasks as $task)
    <div class="card p-2">
        <form class="d-flex justify-content-between align-items-center" action="">
            <input class="w-100 form-control form-control-lg" type="text" name="" id="" value="{{$task->title}}" @cannot('manage-projects') disabled @endcannot>
            <input class="mx-3" type="checkbox" name="" id="">
        </form>
    </div>

@empty
    <h4>No projects found</h4>
@endforelse

