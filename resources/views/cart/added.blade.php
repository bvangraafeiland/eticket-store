@extends('layouts.app')
@section('content')
    <p>The ticket has been added to your cart. <a href="{{route('tickets.index')}}">Go back to the overview</a> or <a
                href="{{route('cart.index')}}">view your cart contents</a>.</p>
@endsection