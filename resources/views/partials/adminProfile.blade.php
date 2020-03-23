<div class="profile-work">
    <p >
        MONITORING PROJECTS :
        <a href="{{ route('admin.projects.index') }}">
            <span class="display-2 text-success"> {{ \App\Project::count() }}</span>
        </a>
    </p>
        <br/>
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
                            <h5>Dissertation Coordinator</h5>
                        </div>
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
