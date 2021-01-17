<div>
    <table class="table text-center">
        <thead>
        <tr >
            <th scope="col">Latest task</th>
            <th scope="col">Task</th>
        </tr>
        </thead>
        @if($tasks != null)
            <tbody>
            @foreach($tasks as $task)
                @if(!$task->completed)
                    <tr>
                        <th scope="row">{{   $task->created_at->diffForHumans() }}</th>
                        <td> {{  'the '}} <strong class="text-danger">supervisor</strong> {{' created task '}} <span class="text-success"># </span>{{'SMOP-mt0'.$task->id}} </td>
                    </tr>
                @else
                    <tr>
                        <th scope="row">{{   $task->updated_at->diffForHumans() }}</th>
                        <td> {{  'the '}} <strong class="text-primary">student</strong> {{' completed task '}} <span class="text-success"># </span>{{'SMOP-mt0'.$task->id}} </td>
                    </tr>
                    <tr>
                        <th scope="row">{{   $task->created_at->diffForHumans() }}</th>
                        <td> {{  'the '}} <strong class="text-danger">supervisor</strong> {{' created task'}} <span class="text-success"># </span>{{'SMOP-mt0'.$task->id}} </td>
                    </tr>
                @endif

            @endforeach
            @if($form != null)
                @if($form->aproved and $tasks == null)
                    <tr>
                        <th scope="row">{{   $form->created_at->diffForHumans() }}</th>
                        <td> <strong class="text-danger">student</strong> submitted an ethical form </td>
                    </tr>
                @else
                    <tr>
                        <th scope="row">{{   $form->updated_at->diffForHumans() }}</th>
                        <td> the <strong class="text-danger">supervisor</strong> approved student's ethical form </td>
                    </tr>
                    <tr>
                        <th scope="row">{{   $form->created_at->diffForHumans() }}</th>
                        <td> the <strong class="text-primary">student</strong> submitted an ethical form </td>
                    </tr>
                @endif
            @endif
            @else
                No tasks added to this project yet

            </tbody>
            <div class="d-flex justify-content-center">
                {{ $tasks->links() }}
            </div>
        @endif
    </table>

</div>
