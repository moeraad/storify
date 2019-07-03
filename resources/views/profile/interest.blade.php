@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Interests</div>

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

                    <form method="post" action="{{route('interest.store')}}">
                    {{ csrf_field() }}
                    <label>Name</label>
                    <input name="name" value="{{old('name')}}"/>

                    <input type="submit" value="Save"/>
                    </form>
                    <ul>
                        @foreach($care_about as $cares)
                        <?php 
                        $interest = $cares->related();
                        $user = $cares->parent();
                        ?>
                        <li>
                        {{$interest->name}} 
                        <a onclick="event.preventDefault();
                            document.getElementById('delete_interest_{{$cares->id}}').submit();">X</a>
                            <form id="delete_interest_{{$cares->id}}" action="{{ route('interest.destroy',$cares->id) }}" 
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
