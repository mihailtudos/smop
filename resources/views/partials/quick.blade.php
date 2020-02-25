<div class="d-flex flex-row-reverse mb-4">
    <a class="btn btn-primary ml-3" href="{{ route('admin.') }}" role="button">Go to the dashboard</a>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Quick links
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('admin.users.create')}}">Create new user</a>
            <a class="dropdown-item" href="{{ route('admin.projects.create')}}">Create new project</a>
        </div>
    </div>
</div>
