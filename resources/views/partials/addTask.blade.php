<form action="{{route('supervisor.tasks.store', $project)}}" method="post">
    @csrf
    <div class="form-group">
        <label for="title">Task<span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" id="title" name="title"  required autofocus placeholder="Task title">
        <small id="title" class="form-text text-muted">Shouldn't be longer than 250 characters</small>

        @error('title')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">Description<span class="text-danger">*</span></label>
        <textarea name="description" class="form-control @error('title') is-invalid @enderror" id="description" required placeholder="Short task description">{{ old('Description') }}</textarea>
        <small id="title" class="form-text text-muted">Shouldn't be longer than 400 characters</small>

        @error('title')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-success float-right">Add task</button>
</form>
