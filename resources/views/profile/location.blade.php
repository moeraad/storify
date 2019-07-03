@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Location</div>

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

                    <form method="post" action="{{route('location.store')}}">
                    {{ csrf_field() }}
                    <label>Country</label>
                    <input name="country" value="{{old('country')}}"/>
                    <label>State</label>
                    <input name="state" value="{{old('state')}}"/>
                    <label>City</label>
                    <input name="city" value="{{old('city')}}"/>
                    <label>From</label>
                    <input name="from" value="{{old('from')}}"/>
                    <label>To</label>
                    <input name="to" value="{{old('to')}}"/>
                    <label>Current</label>
                    <input name="Current" value="{{old('current')}}"/>

                    <input type="submit" value="Save"/>
                    </form>
                    <ul>
                        @foreach($lived as $live)
                        <?php 
                        $location = $live->related();
                        $user = $live->parent();
                        ?>
                        <li>
                        <label>Country: </label> {{$location->country}} 
                        <label>State: </label>{{$location->state}} 
                        <label>City: </label>{{$location->city}} 
                        <label>From: </label>{{$live->from}} 
                        <label>To: </label>{{$live->to}} 
                        <label>Current: </label>{{$live->current}} 
                        <a href="{{route('location.edit',$live->id)}}">[edit]</a>
                        <a onclick="event.preventDefault();
                            document.getElementById('delete_location_{{$live->id}}').submit();">X</a>
                            <form id="delete_location_{{$live->id}}" action="{{ route('location.destroy',$live->id) }}" 
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
