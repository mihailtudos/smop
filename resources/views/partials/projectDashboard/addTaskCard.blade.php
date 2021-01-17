<div class="mt-4">
    <div class="card dashCard">
        <div class="card-header d-flex justify-content-between mt-n2">
            <h4>Add task </h4>
        </div>
        <div class="card-body">

            @if($form != null)
                @if( !$form->approved )
                    @if(auth()->user()->id == $form->user->projects->first()->supervisor->id or auth()->user()->hasRole('admin'))
                        <div class="jumbotron">
                            <p>Before adding any task there must be an ethical form submitted and approved.</p>
                        </div>
                    @endif
                @else
                    @can('admin-supervise')
                        @include('partials.addTask')
                    @endcan
                @endif
            @else
                <p>Before adding any task there must be an ethical form submitted and approved.</p>
            @endif

        </div>
    </div>
</div>
