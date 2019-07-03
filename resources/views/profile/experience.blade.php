@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Experience</div>

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

                    <form method="post" action="{{route('experience.store')}}">
                    {{ csrf_field() }}
                    <label>Name</label>
                    <input name="name" value="{{old("name")}}"/>
                    <label>Location</label>
                    <input name="location" value="{{old("location")}}"/>
                    <label>Position</label>
                    <input name="position" value="{{old("position")}}"/>
                    <label>From</label>
                    <input name="from" value="{{old("from")}}"/>
                    <label>To</label>
                    <input name="to" value="{{old("to")}}"/>
                    <label>Current</label>
                    <input name="Current" value="{{old("current")}}"/>

                    <input type="submit" value="Save"/>
                    </form>
                    <ul>
                        @foreach($worked as $work)
                        <?php 
                        $organisation = $work->related();
                        $user = $work->parent();
                        ?>
                        <li>
                        <label>Name: </label> {{$organisation->name}} 
                        <label>Location: </label>{{$organisation->location}} 
                        <label>Position: </label>{{$work->position}} 
                        <label>From: </label>{{$work->from}} 
                        <label>To: </label>{{$work->to}} 
                        <label>Current: </label>{{$work->current}} 
                        <a href="{{route('experience.edit',$work->id)}}">[edit]</a>
                        <a onclick="event.preventDefault();
                            document.getElementById('delete_work_{{$work->id}}').submit();">X</a>
                            <form id="delete_work_{{$work->id}}" action="{{ route('experience.destroy',$work->id) }}" 
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
