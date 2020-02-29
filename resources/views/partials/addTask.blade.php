<form action="{{route('supervisor.tasks.store', $project)}}" method="post">
    @csrf
    <div class="form-group">
        <label for="title">Task</label>
        <input type="text" class="form-control" value="{{ old('title') }}" id="title" name="title"  required autofocus>
        <small id="title" class="form-text text-muted">Shouldn't be longer than 200 characters</small>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" name="description" class="form-control" id="description">
    </div>
    <input type="hidden" name="project" value="{{$project->id}}" id="project">
    <button type="submit" class="btn btn-success">Add task</button>
</form>
