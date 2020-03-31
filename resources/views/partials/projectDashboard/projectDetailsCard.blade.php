<div class="">
    <div class="card dashCard">
        <div class="card-header d-flex justify-content-between align-items-end">
            <h4>Project Details</h4>
        </div>
        <div class="card-body">
            <div>
                <div class=" ">
                    <div class="mb-4">
                        <h5>Project Title</h5>
                    </div>
                    <div class="px-4">
                        <p class="">
                            {{$project->title}}
                        </p>
                    </div>

                </div>
                <div class=" ">
                    <div class="mb-4">
                        <h5>Members</h5>
                    </div>
                    <div class="px-4">
                        <p class="">
                            <strong>Supervisor :</strong> <a href="{{$project->supervisor->profile->path()}}">{{$project->supervisor->name}}</a>
                        </p>
                        <p class="">
                            <strong>Student :</strong> <a href="{{$project->student->profile->path()}}">{{$project->student->name}}</a>
                        </p>
                    </div>
                </div>
                <div class=" ">
                    <div class="mb-4">
                        <h5>Ethical form</h5>
                    </div>
                    <div class="px-4">
                        @if(!$form == null)
                            @if($form->approved)
                                <p class="">

                                    <strong>Approved on :</strong> <a href="{{ $form->path() }}">{{$form->updated_at->format('yy-m-d')}}</a>
                                </p>
                            @else
                                <p class="">
                                    Awaiting approval... <br>
                                    <strong>Submitted on :</strong> <a href="{{ $form->path() }}"> {{$form->updated_at->format('yy-m-d')}}</a>
                                </p>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="">
                    <div class="mb-4">
                        <h5>Date</h5>
                    </div>
                    <div class="px-4">
                        <p class="">
                            <strong>Submitted on :</strong> {{$project->created_at->format('d-m-yy')}}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
