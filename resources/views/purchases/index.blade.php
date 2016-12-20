@extends('layouts.app')

@section('content')
    <ul class="list-group">
        @foreach($purchases as $purchase)
        <li class="list-group-item"><a href="{{route('purchases.show', $purchase)}}">{{$purchase->created_at}}</a></li>
        @endforeach
    </ul>
@endsection