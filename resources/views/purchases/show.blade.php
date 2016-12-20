@extends('layouts.app')

@section('content')
    <ul class="list-group">
        @foreach($purchase->tickets as $ticket)
            <li class="list-group-item"><a href="{{route('tickets.download', [$purchase, $ticket->pivot->barcode])}}">{{$ticket->title}}</a> ({{$ticket->pivot->barcode}})</li>
        @endforeach
    </ul>
@endsection