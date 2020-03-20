<div class="list-group card dashCard mb-4">
    <!-- side nav -->
    <a href="index.html" class=" list-group-item disabled list-group-item-action active main-color-bg"><h5 class="text-center"><i class="fas fa-cogs"></i> Menu</h5></a>
    @can('admin')
        <a href="{{  '/'.auth()->user()->roles->first()->name .'/posts'  }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-edit"></i> Posts <span class="badge badge-success badge-pill">{{\App\Post::count()}}</span></a>
        <a href="{{ '/'.auth()->user()->roles->first()->name .'/levels' }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-university"></i> Levels <span class="badge badge-success badge-pill">{{\App\Level::count()}}</span></a>
        <a href="{{ '/'.auth()->user()->roles->first()->name .'/fields' }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-book-reader"></i> Fields <span class="badge badge-success badge-pill">{{\App\Field::count()}}</span></a>
        <a href="{{  '/'.auth()->user()->roles->first()->name .'/subjects'   }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-door-open"></i> Subjects <span class="badge badge-success badge-pill">{{\App\Subject::count()}}</span></a>
        <a href="{{  '/'.auth()->user()->roles->first()->name .'/users'   }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-users-cog"></i> Users <span class="badge badge-success badge-pill">{{\App\User::count()}}</span></a>
        <a href="{{ '/suggestions' }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-lightbulb"></i> Ideas <span class="badge badge-success badge-pill">{{\App\ProjectSuggestion::count()}}</span></a>
    @endcan

    @can('supervise')
        <a href="{{ '/suggestions' }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-lightbulb"></i> Ideas <span class="badge badge-success badge-pill">{{auth()->user()->suggestions()->count()}}</span></a>
    @endcan

    @can('student')
        <a href="{{ route('student.topics.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-boxes"></i> Topic <span class="badge badge-success badge-pill">{{ auth()->user()->topics->count() }}</span></a>
        <!-- Button trigger modal -->
        <button type="button" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#suggestionsModal">
            <i class="fas fa-lightbulb"></i> Ideas <span class="badge badge-success badge-pill">{{ \App\ProjectSuggestion::all()->count() }}</span>
        </button>
        <a href="{{ route('student.records.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-calendar-day"></i> Diary <span class="badge badge-success badge-pill">{{ auth()->user()->topics->count() }}</span></a>

        <!-- Modal -->
        @include('partials.modalSuggestions')
    @endcan


    @if(auth()->user()->projects)
        <a @can('manage-projects') href="{{ '/'.auth()->user()->roles->first()->name .'/projects' }}" @endcan @cannot('manage-projects') href="{{ route('studentProjects', auth()->user()->projects)  }}" @endcannot  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"><i class="fas fa-project-diagram"></i> Projects <span class="badge badge-success badge-pill">{{\App\Project::count()}}</span></a>
    @endif
</div>
