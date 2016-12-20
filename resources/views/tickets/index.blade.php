@extends('layouts.app')
@section('content')
    <div class="page-header">
        <h1>Ticket Overview</h1>
        @can('manage-tickets')
            <a href="{{route('tickets.create')}}" class="btn btn-primary">Add a new ticket</a>
        @endcan
    </div>
    <ul class="list-group">
        @foreach($tickets as $ticket)
            <li class="list-group-item"><a href="{{route('tickets.show', $ticket)}}">{{$ticket->title}}</a></li>
        @endforeach
    </ul>
@endsection