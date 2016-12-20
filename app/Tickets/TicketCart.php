<?php
/**
 * Created by PhpStorm.
 * User: b.van.graafeiland
 * Date: 20-12-2016
 * Time: 14:50
 */

namespace App\Tickets;


use App\Ticket;
use Illuminate\Session\Store;

class TicketCart
{
    /**
     * @var Store
     */
    private $session;

    /**
     * SessionTicketStore constructor.
     * @param Store $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function isEmpty()
    {
        return empty($this->getTickets());
    }

    public function put(Ticket $ticket, $amount)
    {
        $sessionKey = $this->getSessionKey($ticket);
        $currentAmount = $this->session->get($sessionKey . '.amount', 0);
        $amount = $currentAmount + $amount;
        $title = $ticket->title;
        $total = ($amount * $ticket->price) / 100;
        $this->session->put($sessionKey, compact('title', 'amount', 'total'));
    }

    public function remove(Ticket $ticket)
    {
        $this->session->forget($this->getSessionKey($ticket));
    }

    /**
     * @param Ticket $ticket
     * @return string
     */
    protected function getSessionKey(Ticket $ticket)
    {
        $id = $ticket->id;
        return "cart.tickets.$id";
    }

    public function getTickets()
    {
        return $this->session->get('cart.tickets', []);
    }

    public function empty()
    {
        $this->session->forget('cart.tickets');
    }
}