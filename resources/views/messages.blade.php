@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Messages</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('message.create')}}">New</a>
                    <div class="row">
                        <div class="col-lg-3">
                            
                        </div>
                        <div class="col-lg-9">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
