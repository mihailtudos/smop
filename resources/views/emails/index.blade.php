@extends('partials.index')

@section('contentIndex')
    <div class="card-header d-flex justify-content-between align-items-end">
        <h4>Sent Emails List</h4>
        <div>
            <a class="btn btn-success border-dark" @can('manage-projects')  href="{{  route( auth()->user()->roles->first()->name.'.'. 'emails.create') }}" @endcan role="button">New email</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table text-center">
            <thead class="thead-dark">
            <tr>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">On</th>
            </tr>
            </thead>
            <tbody>
            @forelse($emails as $email)
                <tr>
                    <td>{{ auth()->user()->email }}</td>
                    <td>{{ App\User::find($email->to_user_id)->email }}</td>
                    <td>{{ $email->created_at }}</td>
                </tr>
            @empty
            @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $emails->links() }}
        </div>

    </div>
@endsection
