@extends('layouts.app')

@section('content')


       <div>
           @include('partials.quick')
       </div>

        <div class="container dashCard emp-profile">
                <div class="row ">
                    <div class="col-md-4 ">
                        <div class="profile-img ">
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
                        @endif
                    </div>
                    <div class="col-md-8 border-right border-success">
                        <div class="d-flex justify-content-center ">
                            <div class="profile-head ">
                               <div>
                                   <h1 class="my-4 border-success border-bottom">
                                       {{ $profile->user->name }}
                                   </h1>
                               </div>

                                <div class="text-center">

                                    <div class="mb-4">
                                        <p class="proile-rating text-left">MAIN COURSE :</p>
                                        <h6>{{ $profile->user->fields->first()->name }}</h6>
                                    </div>
                                    @if(auth()->user()->hasRole('supervisor') and $profile->user_id == auth()->user()->id)
                                    <div>
                                        <p class="proile-rating text-left">PROJECTS :</p>
                                        <h6>  {{$profile->availability .' / ' .$profile->user->monitoredProjects->count() }} </h6>

                                        <form action="" method="post">

                                            <input type="text" name="" id="">
                                        </form>
                                    </div>
                                    @else
                                        <div>
                                            <p class="proile-rating text-left">PROJECT :</p>
                                            <h6>  {{ $profile->user->projects->first()->title }} </h6>
                                        </div>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row ">
                    <div class="col-md-4 border-left border-success">
                        @if(auth()->user()->hasRole('supervisor') and $profile->user_id == auth()->user()->id)
                            <div class="profile-work text-center">
                                <p>SUBJECTS :</p>
                                @foreach($profile->subjects as $subject)
                                    <a href="">{{$subject->name}}</a><br/>
                                @endforeach
                                <form class="mt-2" action="{{route('profile.updateSubject', $profile)}}" method="post">
                                    @csrf
                                    @method('PUT')

                                    <select name="subject" id="subject" class="custom-select" required>
                                        <option value="">Select value</option>
                                        @foreach(\App\Subject::all() as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('subject')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <button class="float-right btn btn-success mt-2" type="submit">Add</button>
                                </form>
                            </div>
                        @endif
                        <div class="profile-work text-center">
                            <p>COURSES :</p>
                            @forelse($profile->user->fields as $field)
                                <a href="">{{$field->name}}</a><br/>
                            @empty
                                <a href="">No courses found</a><br/>
                            @endforelse

                        </div>
                    </div>
                    <div class="col-md-8 my-3 ">

                        <div class="d-flex justify-content-center mb-4">
                            <ul class="nav nav-tabs border-bottom border-success" id="myTab" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link active text-dark" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link text-dark" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content profile-tab justify-content-center d-flex" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>User Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$profile->user->name}}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>User Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$profile->user->email}}</p>
                                    </div>
                                </div>

                                <div  class="row">
                                    <div class="col-md-6">
                                        <label>User Role</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{$profile->user->roles()->first()->name}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>User Field</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $profile->user->fields()->first()->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Experience</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Expert</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success" type="submit">Save changes</button>
                </div>
        </div>

@endsection
