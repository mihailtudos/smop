<form action="{{route('supervisor.tasks.store', $project)}}" method="post">
    @csrf
    <div class="form-group">
        <label for="taskTitle">Task title<span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('taskTitle') is-invalid @enderror" value="{{ old('taskTitle') }}" id="taskTitle" name="taskTitle"  required  placeholder="Task taskTitle">
        <small id="taskTitle" class="form-text text-muted">Shouldn't be longer than 250 characters</small>

        @error('taskTitle')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="taskDescription">Task description<span class="text-danger">*</span></label>
        <textarea name="taskDescription" class="form-control @error('taskTitle') is-invalid @enderror" id="taskDescription" required placeholder="Short task description">{{ old('Description') }}</textarea>
        <small id="taskTitle" class="form-text text-muted">Shouldn't be longer than 400 characters</small>

        @error('taskTitle')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary float-right">Add task</button>
</form>


