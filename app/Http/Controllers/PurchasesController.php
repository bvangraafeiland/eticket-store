<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\Tickets\TicketCart;
use Illuminate\Support\Facades\Auth;

class PurchasesController extends Controller
{
    /**
     * PurchaseController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $purchases = Auth::user()->purchases;
        return view('purchases.index', compact('purchases'));
    }

    public function show(Purchase $purchase)
    {
        $this->authorize('view', $purchase);

        return view('purchases.show', compact('purchase'));
    }

    public function store(TicketCart $cart)
    {
        if ($cart->isEmpty())
            return redirect(route('tickets.index'));

        // add tickets to the user's account
        $tickets = $cart->getTickets();

        $purchase = Auth::user()->purchases()->save(new Purchase);

        foreach ($tickets as $ticketId => $ticketData) {
            $purchase->addTicket($ticketId, $ticketData['amount']);
        }

        // clear cart
        $cart->empty();

        return redirect(route('purchases.index'));
    }
}
