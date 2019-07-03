@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Topics</div>

                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                        </div>
                    @endif

                    <form method="post" action="{{route('topic.store')}}">
                    {{ csrf_field() }}
                    <label>Name</label>
                    <input name="name" value="{{old('name')}}"/>

                    <input type="submit" value="Save"/>
                    </form>
                    <ul>
                        @foreach($knows_about as $knows)
                        <?php 
                        $topic = $knows->related();
                        $user = $knows->parent();
                        ?>
                        <li>
                        {{$topic->name}} 
                        <a onclick="event.preventDefault();
                            document.getElementById('delete_topic_{{$knows->id}}').submit();">X</a>
                            <form id="delete_topic_{{$knows->id}}" action="{{ route('topic.destroy',$knows->id) }}" 
                            method="POST" style="display: none;">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
