@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Feeds</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{route('post.store')}}">
                        {{csrf_field()}}
                        <label>Write something</label><br>
                        <textarea name="content" style="width:100%;"></textarea><br>
                        <label>privacy</label><br>
                        <select name="privacy">
                            <option value="0">Private</option>
                            <option value="1">Public</option>
                        </select><br/>
                        <input type="submit" value="post"/>
                    </form>
                    <hr/>
                    @foreach($wrote as $user_post)
                    <?php
                    $post = $user_post->related();
                    $user = $user_post->parent();
                    ?>
                        <div>
                        <small>{{$user->first_name}} {{$user->last_name}}</small><br>
                        {{$post->content}}
                        <br><small>{{$user_post->created_at->diffForHumans()}}</small>
                        | <small><a href="">{{(int)$post->like}} Likes</a></small>
                        </div>
                        <div>
                        @foreach($post->comments as $comment)
                        <div style="border:1px solid #eee;padding:2px;">
                            <small>{{$user->first_name}} {{$user->last_name}}</small><br>
                            {{$comment->content}}
                            <br><small>{{$comment->created_at->diffForHumans()}}</small>
                        |   <small><a href="">{{(int)$comment->like}} Likes</a></small>
                        </div>
                        @endforeach
                        <form method="post" action="{{route('comment.store')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="post_id" value="{{$post->id}}"/>
                            <textarea name="content" style="width:100%;"></textarea><br/>
                            <input type="submit" value="post"/>
                        </form>
                        </div>
                        <hr/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
