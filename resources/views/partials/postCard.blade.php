<div class="col-md-12 mb-4">
    <div class="card dashCardMini">
        <h5 class="card-header text-center">
           {{$post->title}}
        </h5>
        <img src="{{ '/storage/'.$post->image }}" class="card-img-top" alt="post image">
        <div class="card-body">

            <p class="card-text">
                {{$post->description}}
            </p>
            <a href="{{ $post->path() }}" class="btn btn-primary">Read more...</a>
        </div>
    </div>
</div>
