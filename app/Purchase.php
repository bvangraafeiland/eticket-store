<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'purchased_tickets')->withPivot('barcode');
    }

    public function ticketByBarcode($barcode)
    {
        return $this->tickets()->wherePivot('barcode', $barcode)->first();
    }

    public function addTicket($ticketId, $amount)
    {
        foreach (range(1, $amount) as $index) {
            $this->tickets()->attach($ticketId, ['barcode' => str_random(16)]);
        }
    }
}
