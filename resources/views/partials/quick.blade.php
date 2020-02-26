@if(Auth::user()->hasRole('admin'))
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
@elseif(Auth::user()->hasRole('supervisor'))
    <div class="d-flex flex-row-reverse mb-4">
        <a class="btn btn-primary ml-3" href="{{ route('supervisor.') }}" role="button">Go to the dashboard</a>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Quick links
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('supervisor.projects.create')}}">Create new project</a>
                <a class="dropdown-item" href="{{ route('supervisor.users.edit')}}">Edit user details</a>
            </div>
        </div>
    </div>
@else
    <div class="d-flex flex-row-reverse mb-4">
        <a class="btn btn-primary ml-3" href="{{ route('projects') }}" role="button">Go to the dashboard</a>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Quick links
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
{{--                <a class="dropdown-item" href="{{ route('supervisor.projects.create')}}">Create new project</a>--}}
{{--                <a class="dropdown-item" href="{{ route('supervisor.users.edit')}}">Edit user details</a>--}}
            </div>
        </div>
    </div>

@endif
