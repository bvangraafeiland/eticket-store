@extends('layouts.app')
@section('content')
    <h1>Add ticket to cart</h1>
    <p><strong>Event:</strong> {{$ticket->title}}</p>
    @include('partials.errors')
    <form action="{{route('cart.add', $ticket)}}" method="post">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-2">
                <label for="amount">Amount:</label>
                <input id="amount" name="amount" type="number" class="form-control">
            </div>
        </div>
        <div class="form-group"><button class="btn btn-primary" type="submit">Add to cart</button></div>
    </form>
@endsection