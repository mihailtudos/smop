@extends('layouts.app')

@section('content')


    <div>
        @include('partials.quick')
    </div>
    <div class="container dashCard emp-profile">
        <div class="row ">

            <div class="col-md-4 ">
                <div class="profile-img my-0">
                    <div>
                        <img class="" src="{{ '/storage/uploads/profile.png' }} " alt="user profile image"/>
                    </div>
                </div>
                @if($profile->user_id == auth()->user()->id)
                    <form action="{{route('profile.update', $profile)}}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <label class="custom-file-label ml-4" for="image">Choose file</label>
                                <input onchange="validateSize(this)" type="file" name="image" class="custom-file-input" id="image" aria-describedby="image" required>

                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit" id="image">Upload</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center">
                        <a href="{{ '/password/reset' }}">Change password</a>
                    </div>
                @endif
            @if($profile->user->hasRole('admin'))
                @include('partials.adminProfile')
            @elseif($profile->user->hasRole('supervisor'))
                @include('partials.supervisorProfile')
            @elseif($profile->user->hasRole('student'))
                @include('partials.studentProfile')
            @endif
@endsection
