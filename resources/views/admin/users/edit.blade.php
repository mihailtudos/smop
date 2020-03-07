@extends('layouts.app')

@section('content')
    {{--Quick links--}}
    @include('partials.quick')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header">Edit user {{ $user -> name }}</div>

                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user) }}" method="post">
                            @method('PUT')
                            @csrf

                            <div class="form-group row ">
                                <label for="name" class="col-md-4 col-form-label text-md-right">
                                    Name
                                </label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    Email
                                </label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="roles" class="col-md-4 col-form-label text-md-right">
                                    Roles
                                </label>

                                <div class="col-md-6">
                                    @foreach($roles as $role)
                                        <div class="form-check">
                                            {{--    change radio type to checkbox in order to accept many roles--}}
                                            <input type="radio" name="roles[]" value="{{ $role->id }}"
                                                   @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                            <label>{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="d-flex flex-row-reverse">
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
@endsection
