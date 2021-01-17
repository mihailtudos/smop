@if(Auth::user()->hasRole('admin'))
    <div class="d-flex flex-row-reverse mb-4">
        <a class="btn btn-primary ml-3" href="{{ route('admin.') }}" role="button">Go to the dashboard</a>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Quick links
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @include('partials.adminQuickLinks')
            </div>
        </div>
    </div>
@elseif(Auth::user()->hasRole('supervisor'))
    <div class="d-flex flex-row-reverse mb-4 pt-4">
        <a class="btn btn-primary ml-3" href="{{ route('supervisor.') }}" role="button">Go to the dashboard</a>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Quick action
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @include('partials.supervisorQuickLinks')
            </div>
        </div>
    </div>
@else
    <div class="d-flex flex-row-reverse mb-4">
        <a class="btn btn-primary ml-3" href="{{route('home')}}" role="button">Go to the dashboard</a>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Quick action
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('emails.create')}}">Send Email</a>
{{--                <a class="dropdown-item" href="{{ route('supervisor.users.edit')}}">Edit user details</a>--}}
            </div>
        </div>
    </div>

@endif
