<a class="dropdown-item" href="{{ route('profile.',  auth()->user()->id) }}">
    Profile
</a>
@can('manage-projects')
    <a class="dropdown-item" href="{{ route( auth()->user()->roles->first()->name . '.') }}">
        Dashboard
    </a>
@else
    <a class="dropdown-item" href="">
        Dashboard
    </a>
@endcan
<a class="dropdown-item" href="{{ route('logout') }}"
   onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    {{ __('Logout') }}
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
