@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit user {{ $user -> name }}</div>

                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user) }}" method="post">
                            @method('PUT')
                            @csrf
                            @foreach($roles as $role)
                                    <div class="form-check">
                                        <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $user->roles()->has($role)? 'checked' : '' }} >
                                        <label>{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            <button class="btn btn-success" type="submit">Update</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
