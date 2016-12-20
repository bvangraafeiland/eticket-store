<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketFormRequest;
use App\Purchase;
use App\Ticket;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Picqer\Barcode\BarcodeGeneratorSVG;

class TicketsController extends Controller
{
    /**
     * TicketsController constructor.
     */
    public function __construct()
    {
        $this->middleware('can:manage-tickets')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tickets.index')->with('tickets', Ticket::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TicketFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketFormRequest $request)
    {
        $ticket = Ticket::add($request);

        return redirect(route('tickets.show', $ticket));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        return view('tickets.form', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TicketFormRequest|Request $request
     * @param  \App\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(TicketFormRequest $request, Ticket $ticket)
    {
        $ticket->update($request->all());
        return redirect(route('tickets.show', $ticket));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect(route('tickets.index'));
    }

    public function download(Purchase $purchase, $code)
    {
        $this->authorize('view', $purchase);

        $generator = new BarcodeGeneratorSVG;
        $barcode = $generator->getBarcode($code, $generator::TYPE_CODE_128);
        $ticket = $purchase->ticketByBarcode($code);

        $html = view('tickets.print', compact('barcode', 'ticket'))->render();

        return $html;
        $pdf = new Dompdf;
        $pdf->loadHtml($html);
        $pdf->render();

        return new Response($pdf->output(), 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>  'inline; filename="ticket.pdf"',
        ));
    }
}
