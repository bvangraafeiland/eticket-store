@extends('layouts.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading jumbotron">
            <h1>{{$ticket->title}} <small>{{$ticket->location}}</small></h1>
            <p>{{$ticket->event_date->toDayDateTimeString()}}</p>
        </div>
        <div class="panel-body">
            <div class="col-md-10 col-md-offset-1">
                <p>{{$ticket->description}}</p>
                <p>€{{$ticket->price / 100}}</p>
                <p><a href="{{url("cart/add/$ticket->id")}}" class="btn btn-primary btn-lg">Add to cart</a></p>
            </div>
        </div>
    </div>
@endsection