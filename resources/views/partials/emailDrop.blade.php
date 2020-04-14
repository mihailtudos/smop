<a id="navbarDropdown" class="nav-link text-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
    <i class="text-xxl-center fas fa-envelope-open-text"></i> <span class="caret"></span>
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
    <a class="dropdown-item text-center"
     href="{{ route('emails.index') }}">Outbox</a>
    <a class="dropdown-item text-center"
        @can('admin') href="{{ route('admin.emails.create') }}" @endcan
        @can('supervise') href="{{ route('supervisor.emails.create') }}" @endcan
        @can('student') href="{{ route('emails.create') }}" @endcan>Send emails</a>
</div>

