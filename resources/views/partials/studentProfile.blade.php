

<div class="">

    <div class="profile-work">
        <div>
            @if($profile->user->projects != null)
                <p>PROJECT :</p>
                <h6>  {{ $profile->user->projects->first()->title }} </h6>
            @else
                <p>TOPICS :</p>
                @if($profile->user->topics != null)
                    <ol>
                        @foreach($profile->user->topics as $topic)
                           <li>
                               <a class="text-primary" href="{{ $topic->path() }}">
                                   <h6>{{ Str::limit($topic->title, '100') }}</h6>
                               </a>
                           </li>
                        @endforeach
                    </ol>
                @endif
            @endif
        </div>

    </div>
    <div class="profile-work">
        <p>SUPERVISOR :</p>
        @if($profile->user->projects != null)
            <a class="text-primary" href="{{ $profile->user->projects->supervisor->profile->path() }}">{{ $profile->user->projects->supervisor->name }}</a><br/>
        @endif

    </div>
</div>

</div>
<div class="col-md-8 border-left border-success">
    <div class="">
        <div class="d-flex justify-content-center mb-4">
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
                    <div class="">
                        <div>
                            <h1 class="my-4 border-success border-bottom text-center">
                                {{ $profile->user->name }}
                            </h1>
                        </div>

                        <div class="">
                            <div class="my-5">
                                <p class="proile-rating text-left">MAIN COURSE :</p>
                                <p class="text-success font-weight-bold">{{ $profile->user->fields->first()->name }}</p>
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
                                <label>Reg date</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $profile->user->created_at->format('d-m-yy') }}</p>
                            </div>
                        </div>

                        @if($profile->user->ethicalForm != null)
                            <div class="row">
                                <div class="col-md-6">
                                    @if($profile->user->ethicalForm->approved)
                                        <td><a href="{{$profile->user->ethicalForm->path()}}">{{ 'Approved'  }}</a> </td>
                                    @else
                                        <td><a href="{{$profile->user->ethicalForm->path()}}">{{ 'Pending'  }}</a> </td>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $profile->user->ethicalForm->updated_at->format('d-m-yy') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
            <div class="tab-pane  fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="overflow-auto" style="height: 460px">
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
