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
                            <strong>Supervisor :</strong> {{$project->supervisor->name}}
                        </p>
                        <p class="">
                            <strong>Student :</strong> {{$project->student->name}}
                        </p>
                    </div>
                </div>
                <div class="">
                    <div class="mb-4">
                        <h5>Start date</h5>
                    </div>
                    <div class="px-4">
                        <p class="">
                            {{$project->created_at->format('d-m-yy')}}
                        </p>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
