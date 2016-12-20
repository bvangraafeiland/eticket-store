<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Tickets\TicketCart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param TicketCart $cart
     * @return \Illuminate\Http\Response
     */
    public function index(TicketCart $cart)
    {
        $tickets = $cart->getTickets();
        $totalPrice = collect($tickets)->map(function ($ticket) {
            return $ticket['total'];
        })->sum();
        return view('cart.overview', compact('tickets', 'totalPrice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function create(Ticket $ticket)
    {
        return view('cart.add', compact('ticket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param TicketCart $cart
     * @param Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TicketCart $cart, Ticket $ticket)
    {
        $this->validate($request, [
            'amount' => 'required|integer'
        ]);
        $cart->put($ticket, $request->amount);
        return view('cart.added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TicketCart $cart
     * @param Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketCart $cart, Ticket $ticket)
    {
        $cart->remove($ticket);
        return redirect(route('cart.index'));
    }


}
