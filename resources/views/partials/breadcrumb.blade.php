
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
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
    </div>
</div>

