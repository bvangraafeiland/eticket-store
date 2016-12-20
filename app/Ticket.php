<?php

namespace App;

use App\Http\Requests\TicketFormRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['title', 'description', 'location', 'price'];

    protected $casts = [
        'event_date' => 'datetime'
    ];

    public static function add(TicketFormRequest $request)
    {
        $ticket = new static($request->all());
        list($year, $month, $day) = [$request->event_date_year, $request->event_date_month, $request->event_date_day];
        $ticket->event_date = new Carbon("$year-$month-$day");
        $ticket->price = $request->price * 100;
        $ticket->save();

        return $ticket;
    }
}
