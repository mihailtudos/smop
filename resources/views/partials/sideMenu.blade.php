<div class="list-group card dashCard mb-4">
    <!-- side nav -->
    <a href="index.html" class=" list-group-item disabled list-group-item-action active main-color-bg"><h5 class="text-center"><i class="fas fa-cogs"></i> Menu</h5></a>
    @can('admin')
        <a href="{{  '/'.auth()->user()->roles->first()->name .'/posts'  }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-edit"></i> Posts <span class="badge badge-success badge-pill">{{\App\Post::count()}}</span></a>
        <a href="{{ '/'.auth()->user()->roles->first()->name .'/fields' }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-book-reader"></i> Fields <span class="badge badge-success badge-pill">{{\App\Field::count()}}</span></a>
        <a href="{{ '/'.auth()->user()->roles->first()->name .'/levels' }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-university"></i> Levels <span class="badge badge-success badge-pill">{{\App\Level::count()}}</span></a>
        <a href="{{  '/'.auth()->user()->roles->first()->name .'/users'   }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-users-cog"></i> Users <span class="badge badge-success badge-pill">
            @if(auth()->user()->hasRole('admin'))
                    {{\App\User::count()}}
                @else
                    {{\App\Project::where('supervisor_id', auth()->user()->id)->get()->count()}}
                @endif
        </span></a>
    @endcan

    <a href="{{ '/suggestions' }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-lightbulb"></i> Ideas <span class="badge badge-success badge-pill">{{\App\ProjectSuggestion::count()}}</span></a>

    @if(auth()->user()->projects)
        <a @can('manage-projects') href="{{ '/'.auth()->user()->roles->first()->name .'/projects' }}" @endcan @cannot('manage-projects') href="{{ route('studentProjects', auth()->user()->projects)  }}" @endcannot  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-project-diagram"></i> Projects <span class="badge badge-success badge-pill">{{\App\Project::count()}}</span></a>
    @endif
</div>
