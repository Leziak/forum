<article>
    <h4 class="card-title">
        <a href="/users/{{$reply->owner->id}}">{{$reply->owner->name}}</a>
        said
        {{$reply->created_at->diffForHumans()}}
    </h4>
    <div class="card-body">{{$reply->body}}</div>
</article>
<hr>