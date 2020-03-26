<div class="mt-4">
    <div class="card dashCard">
        <div class="card-header d-flex justify-content-between mt-n2">
            <h4>Add task </h4>
        </div>
        <div class="card-body">


            @if( !$form->approved )
                @if(auth()->user()->id == $form->user->projects->first()->supervisor->id or auth()->user()->hasRole('admin'))
                    <div class="jumbotron ">
                        <div class="d-flex justify-content-center">
                            <div>
                                <h4 class="mb-2 text-center">Approve <a href="{{$project->student->ethicalForm->path()}}">student ethical form</a></h4>
                            </div>
                        </div>
                        <div class="text-center">
                            <small>To be able to add tasks, please approve student's ethical form</small>
                        </div>
                    </div>
                @endif
            @else
                @can('admin-supervise')
                    @include('partials.addTask')
                @endcan
            @endif
        </div>
    </div>
</div>
