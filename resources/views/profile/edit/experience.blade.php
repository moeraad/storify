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

                    <?php $experience = $worked->related(); ?>
                    <form method="post" action="{{route('experience.update',$experience->id)}}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <label>Name</label>
                        <input name="id" type="hidden" value="{{$experience->id}}"/>
                        <input name="edge_id" type="hidden" value="{{$worked->id}}"/>
                        <input name="name" value="{{$experience->name}}"/>
                        <label>Location</label>
                        <input name="location" value="{{$experience->location}}"/>
                        <label>Position</label>
                        <input name="position" value="{{$worked->position}}"/>
                        <label>From</label>
                        <input name="from" value="{{$worked->from}}"/>
                        <label>To</label>
                        <input name="to" value="{{$worked->to}}"/>
                        <label>Current</label>
                        <input name="Current" value="{{$worked->current}}"/>

                        <input type="submit" value="Save"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
