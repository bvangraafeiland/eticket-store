@extends('layouts.app')
@section('content')
    @if (empty($tickets))
    <tr>No items in your cart.</tr>
    @else
    <table class="table">
        <thead>
        <tr>
            <th>Event name</th>
            <th>Amount of tickets</th>
            <th>total price</th>
        </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticketId => $ticket)
                <tr>
                    <td>{{$ticket['title']}}</td>
                    <td>{{$ticket['amount']}}</td>
                    <td>€{{$ticket['total']}}</td>
                    <td>
                        <form action="{{route('cart.destroy', $ticketId)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('delete')}}
                            <button type="submit" class="btn btn-danger">Remove tickets</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>The total price of your tickets is €{{$totalPrice}}</p>
    <form action="{{route('purchases.store')}}" method="post">
        {{csrf_field()}}
        <button class="btn btn-success" type="submit">Purchase tickets</button>
    </form>
    @endif
@endsection