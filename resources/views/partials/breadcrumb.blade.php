
<div class="mt-2 mb-4 d-flex justify-content-between">
    <div class=" ">
        <h1><i class="fas fa-cogs"></i> <small>Welcome to your {{ auth()->user()->roles->first()->name }}  </small></span> Dashboard </h1>
    </div>

    <div class="mb-2">
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Quick action
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                @can('student')
                    @include('partials.userQuickLinks')
                @endcan
                @can('admin')
                    @include('partials.adminQuickLinks')
                @endcan
                @can('supervise')
                    @include('partials.supervisorQuickLinks')
                @endcan
            </div>
        </div>
    </div>
</div>

