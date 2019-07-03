@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">School</div>

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

                    <?php $school = $studied->related(); ?>
                    <form method="post" action="{{route('school.update',$school->id)}}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <label>Name</label>
                        <input name="id" type="hidden" value="{{$school->id}}"/>
                        <input name="edge_id" type="hidden" value="{{$studied->id}}"/>
                        <input name="name" value="{{$school->name}}"/>
                        <label>Location</label>
                        <input name="location" value="{{$school->location}}"/>
                        <label>Degree</label>
                        <input name="degree" value="{{$studied->degree}}"/>
                        <label>Field</label>
                        <input name="field" value="{{$studied->field}}"/>
                        <label>From</label>
                        <input name="from" value="{{$studied->from}}"/>
                        <label>To</label>
                        <input name="to" value="{{$studied->to}}"/>
                        <label>Current</label>
                        <input name="Current" value="{{$studied->current}}"/>

                        <input type="submit" value="Save"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
