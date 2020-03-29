<div>
    @forelse($tasks as $task)
        @if($task->completed)
        @else
            <div class="card p-3 mb-3 border-bottom border-success">
                <div>
                    <h3><span class="display-4">#</span>{{'SMOP-mt0'.$task->id}}</h3>
                    <h4>{{$task->title}}</h4>
                </div>
                <form class="d-flex justify-content-between align-items-center" action="">
                    <input class="w-100 form-control form-control-lg " type="text" name="" id="" value="{{$task->description}}" disabled>
                </form>
                <div class="d-flex align-content-end justify-content-end mt-5 border-success border-top">
                    <div class="mt-2">
                        <form id="competeTask" action="{{route('home')}}" method="post">
                            @csrf
                            @method('put')
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" onchange="$('#competeTask').submit();" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Complete</label>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            @endif
    @empty
        <h4>No tasks found</h4>
    @endforelse
</div>
