@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Forum Threads</div>
                    <article>
                        <h4 class="card-title">
                            <a href="/users/{{$thread->creator->id}}">{{$thread->creator->name}}</a>
                            posted:
                            {{$thread->title}}
                        </h4>

                    </article>
                    <div class="card-body">{{$thread->body}}</div>
                    <hr>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach($thread->replies as $reply)
                        @include('threads.reply')
                    @endforeach
                </div>
            </div>
        </div>

        @if(auth()->check())
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="POST" action="{{$thread->path() . '/replies'}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" placeholder="Have something to say?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Post</button>
                    </form>
                </div>
            </div>

        @else
            <p class="text-center">
                Please <a href="{{ route('login') }}">sign in</a> to participate.
            </p>
        @endif
    </div>
    </div>
@endsection