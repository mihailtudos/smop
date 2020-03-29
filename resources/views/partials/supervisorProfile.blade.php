
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

    @else

        <div class="">
            <p>SUBJECTS :</p>
            @foreach($profile->subjects as $subject)

                <label>{{ $subject->name }}</label>
                <a  href="{{ route('profile.detachSubject', array($profile, $subject)) }}"></a>
                <br/>
            @endforeach
        </div>

    @endif
        <div class=" overflow-auto mt-4 " style="height: 250px">
            <p class=" text-left ">MONITORED PROJECTS :</p>
            <ol class="">
                @foreach($profile->user->monitoredProjects as $project)
                    <li class="mt-3">
                        <a class="text-primary" href="{{ $project->path() }}">{{ $project->title }}</a>
                    </li>
                @endforeach
            </ol>
        </div>
</div>

</div>
<div class="col-md-8 border-left border-success">
    <div class="">
        <div>
            <div class="d-flex justify-content-center mt-4">
                <div>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-dark font-weight-bold" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark font-weight-bold" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Activity</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="d-flex justify-content-center">
                        <div>
                            <div>
                                <h1 class="my-4 border-success border-bottom">
                                    {{ $profile->user->name }}
                                </h1>
                            </div>

                            <div class="profile-head ">
                                <div class="my-5 text-center">
                                    <p class="proile-rating text-left">MAIN COURSE :</p>
                                    <h6 class="font-weight-bold">{{ $profile->user->fields->first()->name }}</h6>
                                </div>
                                @if(auth()->user()->hasRole('admin') or auth()->user()->hasRole('supervisor') and $profile->user_id == auth()->user()->id)
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
                                    <label>Reg date</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $profile->user->created_at->format('d-m-yy') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div>
                        <div class="overflow-auto" style="height: 330px">
                            <table class="table text-center ">
                                <thead>
                                <tr>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                                </thead>
                                <tbody >
                                @if($profile->user->activities->first() != null)
                                    @foreach($profile->user->activities as $activity)
                                        <tr>
                                            <th scope="row">{{ $activity->created_at->format('d-m-yy') }}</th>
                                            <td>{{ $activity->activityTitle->activity_title }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th scope="row">{{ $profile->created_at->format('d-m-yy') }}</th>
                                        <td>{{ 'account created' }}</td>
                                    </tr>
                                @else
                                    <th scope="row">{{ $profile->created_at->format('d-m-yy') }}</th>
                                    <td>{{ 'account created' }}</td>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

