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

                    <?php $location = $lived->related(); ?>
                    <form method="post" action="{{route('location.update',$location->id)}}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <label>Country</label>
                        <input name="id" type="hidden" value="{{$location->id}}"/>
                        <input name="edge_id" type="hidden" value="{{$lived->id}}"/>
                        <input name="country" value="{{$location->country}}"/>
                        <label>State</label>
                        <input name="state" value="{{$location->state}}"/>
                        <label>city</label>
                        <input name="city" value="{{$location->city}}"/>
                        <label>From</label>
                        <input name="from" value="{{$lived->from}}"/>
                        <label>To</label>
                        <input name="to" value="{{$lived->to}}"/>
                        <label>Current</label>
                        <input name="Current" value="{{$lived->current}}"/>

                        <input type="submit" value="Save"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
