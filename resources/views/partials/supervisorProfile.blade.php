
            <div class="">
                @if(auth()->user()->hasRole('supervisor') and $profile->user_id == auth()->user()->id)
                    <div class="profile-work">

                        <p>SUBJECTS :</p>
                        @foreach($profile->subjects as $subject)

                            <label>{{ $subject->name }}</label>
                            <a  href="{{ route('profile.detachSubject', array($profile, $subject)) }}"><span class="text-danger"> X </span></a>
                            <br/>
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
                    <div class="profile-work">
                        <p class="proile-rating text-left">MONITORED PROJECTS :</p>
                        <ol class="">
                            @foreach($profile->user->monitoredProjects as $project)
                                <li ><a class="text-primary" href="{{ $project->path() }}">{{ $project->title }}</a></li>
                            @endforeach
                        </ol>
                    </div>
                    @else
                    <div class="profile-work">

                        <p>SUBJECTS :</p>
                        @foreach($profile->subjects as $subject)

                            <label>{{ $subject->name }}</label>
                            <a  href="{{ route('profile.detachSubject', array($profile, $subject)) }}"></a>
                            <br/>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
        <div class="col-md-8 border-left border-success">
            <div class="d-flex justify-content-center ">
                <div class="profile-head ">
                    <div>
                        <h1 class="my-4 border-success border-bottom">
                            {{ $profile->user->name }}
                        </h1>
                    </div>

                    <div class="">
                        <div class="my-5">
                            <p class="proile-rating text-left">MAIN COURSE :</p>
                            <h6>{{ $profile->user->fields->first()->name }}</h6>
                        </div>
                        @if(auth()->user()->hasRole('supervisor') and $profile->user_id == auth()->user()->id)
                            <div class="my-5">
                                <p class="proile-rating text-left">AVAILABILITY :</p>
                                <form class="mt-2" action="{{route('profile.updateSubject', $profile)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3 class="text-primary">{{ $profile->availability }}</h3>
                                        </div>
                                        <div>
                                            <input hidden type="number" name="availability" id="availability" value="1">
                                            <button onclick="$('#availability').val(1)" class="btn btn-success" type="submit">+</button>
                                            <button onclick="$('#availability').val('-1')" class="btn btn-danger" type="submit">-</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-5">

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
    </div>
</div>
