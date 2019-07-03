@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Compose message</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('message.index')}}">Show messages</a>
                    <form method="post" action="{{route('message.store')}}">
                    {{csrf_field()}}
                    <label>To</label><br/>
                    <select name="recepient">
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                    @endforeach
                    </select><br/>
                    <label>Content</label><br/>
                    <textarea name="content">{{old('')}}</textarea><br/>
                    
                    <input type="submit" value="send"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
