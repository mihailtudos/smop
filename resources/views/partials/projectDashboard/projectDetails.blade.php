<div>
    <div class="jumbotron dashCardMini">
        <div class="mb-4">
            <h2>Title</h2>
        </div>
        <div>
            <h3 class="text-center">
                {{$project->title}}
            </h3>
        </div>

    </div>
    <div class="jumbotron dashCardMini">
        <div class="mb-4">
            <h2>Members</h2>
        </div>
        <div>
            <h3 class="text-center">
                {{$project->supervisor->name}}
            </h3>
            <h3 class="text-center">
                {{$project->student->name}}
            </h3>
        </div>
    </div>
    <div class="jumbotron dashCardMini">
        <div class="mb-4">
            <h2>Dates</h2>
        </div>
        <div>
            <h3 class="text-center">
                {{$project->created_at->format('d-m-yy')}}
            </h3>

        </div>
    </div>
</div>
