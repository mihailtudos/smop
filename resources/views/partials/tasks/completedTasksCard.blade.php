<div class="card p-3 mb-3 border-bottom border-success">
    <div>
        <h4><span class="text-success"># </span>{{'SMOP-mt0'.$task->id}}</h4>
    </div>
    <div>
        <input class="w-100 form-control form-control-lg " type="text" value="{{$task->title}}" disabled>
    </div>
    <div class="d-flex justify-content-end mt-2 border-success border-top">
        <p class="pt-3 mb-0">This task was completed on {{$task->updated_at->diffForHumans()}}</p>
    </div>
</div>
