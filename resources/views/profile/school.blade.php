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

                    <form method="post" action="{{route('school.store')}}">
                    {{ csrf_field() }}
                    <label>Name</label>
                    <input name="name" value="{{old('name')}}"/>
                    <label>Location</label>
                    <input name="location" value="{{old('location')}}"/>
                    <label>Degree</label>
                    <input name="degree" value="{{old('degree')}}"/>
                    <label>Field</label>
                    <input name="field" value="{{old('field')}}"/>
                    <label>From</label>
                    <input name="from" value="{{old('from')}}"/>
                    <label>To</label>
                    <input name="to" value="{{old('to')}}"/>
                    <label>Current</label>
                    <input name="Current" value="{{old('Current')}}"/>

                    <input type="submit" value="Save"/>
                    </form>
                    <ul>
                        @foreach($studied as $study)
                        <?php 
                        $school = $study->related();
                        $user = $study->parent();
                        ?>
                        <li>
                        <label>Name: </label> {{$school->name}} 
                        <label>Location: </label>{{$school->location}} 
                        <label>Degree: </label>{{$study->degree}} 
                        <label>Field: </label>{{$study->field}} 
                        <label>From: </label>{{$study->from}} 
                        <label>To: </label>{{$study->to}} 
                        <label>Current: </label>{{$study->current}} 
                        <a href="{{route('school.edit',$study->id)}}">[edit]</a>
                        <a onclick="event.preventDefault();
                            document.getElementById('delete_school_{{$study->id}}').submit();">X</a>
                            <form id="delete_school_{{$study->id}}" action="{{ route('school.destroy',$study->id) }}" 
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
